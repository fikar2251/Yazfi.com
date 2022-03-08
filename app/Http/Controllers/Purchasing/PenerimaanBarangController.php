<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenerimaanRequest;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenerimaanBarangController extends Controller
{
    public function index(PenerimaanBarang $penerimaan)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $penerimaans = PenerimaanBarang::groupBy('no_penerimaan_barang')->whereBetween('tanggal_penerimaan', [$from, $to])->get();
        } else {
            $penerimaans = PenerimaanBarang::groupBy('no_penerimaan_barang')
            ->orderBy('tanggal_penerimaan', 'desc')->get();
        }

        return view('purchasing.penerimaan-barang.index', compact('penerimaans'));
    }
    public function search(Request $request)
    {
        $data = [];
        $tukar = Purchase::select(
            "id"
            // "invoice",
            // "grand_total",
            // "supplier_id",
            // "status_barang",
            // "total",
            // "harga_beli",
            // "created_at",
            // "project_id",
            // "lokasi",
            // "barang_id",
            // "qty",
            // "PPN"
        )->where('status_barang', 'pending')->where('invoice', $request->invoice)->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'id' => $value->id,
                    // 'project_id' => $value->project->nama_project,
                    // 'lokasi' => $value->lokasi,
                    // 'created_at' => $value->created_at,
                    // 'supplier_id' => $value->supplier->nama,
              
                ];
            }
        }
        return $data;
    }
    public function create(Purchase $purchase,Request $request)
    {
        // $tukar = Purchase::where('status_barang', 'pending')->where('invoice', $purchase->invoice)->get();

        $purchases = Purchase::where('status_barang', 'pending')->where('invoice',$request->invoice)->get();

        $AWAL = 'PN';
        $noUrutAkhir = \App\PenerimaanBarang::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        
        $purchase = Purchase::groupBy('invoice')->get();
        
      
      
        // dd($tukar);
        return view('purchasing.penerimaan-barang.create', compact('tukar', 'purchases', 'purchase','nourut'));
    }


    public function store(StorePenerimaanRequest $request)
    {
        $request->validate([
            'id_user' => 'required',
            'no_penerimaan_barang' => 'required',
            'tanggal_penerimaan' => 'required',
            'harga_beli' => 'required',
            'total' => 'required',
            'qty_received' => 'required',
        ]);

      
        $barang = $request->input('barang_id', []);
      

        $attr = [];
        
     
      
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $purchases = Purchase::where('barang_id', $no)->first()->id;
            $attr []= [
                'id_user' => $request->id_user,
                'no_po' => $request->no_po,
                'no_penerimaan_barang' => $request->no_penerimaan_barang,
                'barang_id' => $no,
                'id_purchase' => $purchases,
                'qty' => $request->qty[$key],
                'qty_received' => $request->qty_received[$key],
                'harga_beli' => $request->harga_beli[$key],
                'total' => $request->total,
                'tanggal_penerimaan' => $request->tanggal_penerimaan,
                'status_tukar_faktur' => 'pending',
            ];

       
            $purchase = Purchase::where('barang_id', $no)->get();
            //  dd($purchase);
         
            if ( $request->status_barang[$key] == 'completed') {
                DB::table('purchases')->whereIn('id', $purchase)->update(array( 
                    'qty' => $request->qty[$key],
                    'harga_beli' =>$request->harga_beli[$key],
                    'total' => $request->harga_beli[$key] * $request->qty[$key],
                    'status_barang' => $request->status_barang[$key]));

                 } else {
                  

        
                }
        // dd($array);
        }
        PenerimaanBarang::insert($attr);
        DB::commit();
        
        return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Penerimaan barang berhasil');
    }


    public function edit($id,Purchase $purchase,Request $request )
    {
        
        $penerimaans = PenerimaanBarang::where('id', $id)->get();

         
        $purchase = DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        ->leftJoin('projects','purchases.project_id','=','projects.id')
        ->select('penerimaan_barangs.id','suppliers.nama','purchases.created_at','purchases.lokasi','projects.nama_project')
        ->first();
        // dd($purchase);
        
        $AWAL = 'PN';
        $noUrutAkhir = \App\PenerimaanBarang::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        
        // $purchase = Purchase::groupBy('invoice')->get();
        return view('purchasing.penerimaan-barang.edit', compact('nourut', 'purchase','penerimaan','penerimaans'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'invoice' => 'required',
        ]);
        $barang = $request->input('barang_id', []);
        $attr = [];
        // $in = [];
        $id = [];
        $purchases = Purchase::where('invoice', $purchase->invoice)->pluck('id');
        dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr []= [
                'id_user' => $request->id_user,
                'id_purchase' => $request->id_purchase,
                'no_penerimaan_barang' => $request->no_penerimaan_barang,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'qty_received' => $request->qty_received[$key],
                'harga_beli' => $request->harga_beli[$key],
                'total' => $request->total,
                'tanggal_penerimaan' => $request->tanggal_penerimaan,
            ];
        //   dd($attr);

            $purchases = Purchase::where('id', $request->id_purchase)->where('barang_id', $no)->first();
            // dd($purchases);
            $purchases->update([
                'qty' => $request->qty[$key],
                'harga_beli' =>$request->harga_beli[$key],
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'status_barang' => $request->status_barang[$key]
            ]);
            $id[] = $purchases[$key];
            // dd($attr);
           
        }
        PenerimaanBarang::updateOrInsert([
            'id' => $id
        ], $attr);
        DB::commit();
       
        return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Update Penerimaan barang berhasil');
    }

    public function destroy( $id)
    {
        // $post = PenerimaanBarang::findOrFail($id);
        // $purchase = Purchase::where('id', $post)->first();
        $penerimaans = PenerimaanBarang::where('id', $id)->get();
        // dd($penerimaans);
        foreach ($penerimaans as $pur) {
            $purchase = Purchase::where('barang_id', $pur->barang_id)->get();
            // dd($purchase);
            DB::table('purchases')->whereIn('id', $purchase)->update(array( 
                'status_barang' => 'pending'));
        
            $pur->delete();
        }
            
        return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Penerimaan Barang barang didelete');
    }

    public function whereProject(Request $request)
    {
        $data = DB::table('projects')
            ->select('projects.alamat_project')
            ->groupBy('projects.alamat_project')
            ->where('projects.id', $request->id)->get();
        return $data;
        dd($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  Barang::where('jenis', 'barang_id')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang didelete');
    }
}
