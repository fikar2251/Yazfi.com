<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\Project;
use App\TukarFaktur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TukarFakturController extends Controller
{
    public function index(Purchase $purchase)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $purchases = TukarFaktur::groupBy('no_faktur')->whereBetween('tanggal_tukar_faktur', [$from, $to])->get();
        } else {
            $purchases = TukarFaktur::groupBy('no_faktur')->get();
        }


        return view('purchasing.tukarfaktur.index', compact('purchases'));
    }

    public function create()
    {
        $purchasing = DB::table('dokumen_tukar_faktur')->get();

        return view('purchasing.tukarfaktur.create', compact('purchasing'));
    }

    public function store(Request $request)
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
        $in = [];
        // dd($request->all());
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'project_id' => $request->project_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'status_pembayaran' => 'pending',
                'status_barang' => 'pending'
            ];

            // $hargaBarang = HargaProdukCabang::where('project_id', auth()->user()->project_id)->where('barang_id', $no)->first();

            // $hargaBarang->update([
            //     'qty' => $hargaBarang->qty + $request->qty[$key]
            // ]);

            $in[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'project_id' => $request->project_id,
                'in' => $request->qty[$key],
                'user_id' => auth()->user()->id
            ];
        }

        Purchase::insert($attr);
        InOut::insert($in);

        DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Purchase barang berhasil');
    }
    public function search(Request $request)
    {
        $data = [];
        $tukar = Purchase::select("id", "invoice", "grand_total", "supplier_id")->where('status_barang', 'pending')->where('invoice', $request->invoice)->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'invoice' => $value->invoice,
                    'supplier_id' => $value->supplier_id,
                    'grand_total' => $value->grand_total,
                ];
            }
        }
        return $data;
    }

    public function show(TukarFaktur $tukar)
    {
        $purchasing = DB::table('dokumen_tukar_faktur')->get();
        $tukar = DB::table('tukar_fakturs')
            ->leftJoin('suppliers', 'tukar_fakturs.supplier_id', '=', 'suppliers.id')
            ->select('suppliers.nama', 'tukar_fakturs.no_faktur', 'tukar_fakturs.nilai_invoice', 'tukar_fakturs.tanggal_tukar_faktur')
            ->first();
        return view('purchasing.tukarfaktur.show', compact('purchasing', 'tukar'));
    }

    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $suppliers = Supplier::get();
        $project = Project::get();
        $barangs = Barang::where('jenis', 'barang')->get();

        return view('purchasing.tukarfaktur.edit', compact('project', 'purchase', 'suppliers', 'barangs', 'purchases'));
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
        // dd("ok");
        // dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'status_pembayaran' => 'pending',
                'status_barang' => 'pending'
            ];
            $id[] = $purchases[$key];
        }

        // Purchase::updateOrInsert([
        //     'id' => $id
        // ], $attr);

        // InOut::insert($in);

        DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Purchase barang berhasil');
    }

    public function destroy(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();

        foreach ($purchases as $pur) {
            InOut::where('invoice', $pur->invoice)->delete();
            // $harga = HargaProdukCabang::where('barang_id', $pur->barang_id)->where('project_id', auth()->user()->project_id)->first();

            // // $harga->update([
            // //     'qty' => $harga->qty - $pur->qty
            // // ]);
            $pur->delete();
        }

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Purchase barang didelete');
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

        return $data;
        dd($data);
    }
}
