<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            $penerimaans = PenerimaanBarang::orderBy('tanggal_penerimaan', 'desc')->get();
        }

        return view('purchasing.penerimaan-barang.index', compact('penerimaans'));
    }
    public function search(Request $request)
    {
        $data = [];
        $tukar = Purchase::select(
            "id",
            "invoice",
            "grand_total",
            "supplier_id",
            "status_barang",
            "total",
            "harga_beli",
            "created_at",
            "project_id",
            "lokasi",
            "barang_id",
            "qty"
        )->where('status_barang', 'pending')->where('invoice', $request->invoice)->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'project_id' => $value->project->nama_project,
                    'lokasi' => $value->lokasi,
                    'created_at' => $value->created_at,
                    'supplier_id' => $value->supplier->nama,
                    'barang_id' => $value->barang->nama_barang,
                    'qty' => $value->qty,
                    'harga_beli' => $value->harga_beli,
                    'total' => $value->total,
                    'status_barang' => $value->status_barang,
                    'grand_total' => $value->grand_total,
                ];
            }
        }
        return $data;
    }
    public function create(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $AWAL = 'PN';
        $noUrutAkhir = \App\Purchase::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        return view('purchasing.penerimaan-barang.create', compact('purchases', 'purchase', 'nourut'));
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
                'lokasi' => $request->lokasi,
                'project_id' => $request->project_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'unit' => $request->unit[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'grand_total' => $request->grandtotal,
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

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang berhasil');
    }

    public function show(Purchase $purchase)
    {
        $purchase = Purchase::where('invoice', $purchase->invoice)->first();

        return view('logistik.purchase.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $suppliers = Supplier::get();
        $project = Project::get();
        $barangs = Barang::where('jenis', 'barang')->get();

        return view('logistik.purchase.edit', compact('project', 'purchase', 'suppliers', 'barangs', 'purchases'));
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
                'unit' => $request->unit[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'grand_total' => $request->grand_total,
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

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang berhasil');
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

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang didelete');
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
