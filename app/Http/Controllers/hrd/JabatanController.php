<?php

namespace App\Http\Controllers\hrd;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Jabatan;
use App\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    public function index()
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');

            $jabatan = Jabatan::groupBy('nama')->whereBetween('created_at', [$from, $to])->get();
        } else {
            $jabatan = Jabatan::groupBy('nama')->get();
        }

        return view('hrd.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        $jabatan = Jabatan::get();
        $perusahaans = Perusahaan::get();
        return view('hrd.jabatan.create', compact('jabatan', 'perusahaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_perusahaan' => 'required',
        ]);
        $attr = $request->all();
        Purchase::insert($attr);
        DB::commit();
        return redirect()->route('hrd.jabatan.index')->with('success', 'Nama Jabatan berhasil');
    }

    public function edit(Jabatan $jabatan)
    {
        $jabatan = Jabatan::where('id', $jabatan->id)->get();
        return view('hrd.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Purchase $purchase)
    {

        $request->validate([
            'nama' => 'required',
            'id_perusahaan' => 'required',
        ]);
        $attr = $request->all();
        Purchase::insert($attr);
        DB::commit();
        return redirect()->route('hrd.jabatan.index')->with('success', 'Nama Jabatan berhasil');
    }

    public function destroy(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();

        foreach ($purchases as $pur) {
            InOut::where('invoice', $pur->invoice)->delete();
            $harga = HargaProdukCabang::where('barang_id', $pur->barang_id)->where('cabang_id', auth()->user()->cabang_id)->first();

            $harga->update([
                'qty' => $harga->qty - $pur->qty
            ]);

            $pur->delete();
        }

        return redirect()->route('admin.purchase.index')->with('success', 'Purchase barang didelete');
    }

    public function WhereService(Request $request)
    {
        $data = [];
        $product =  Barang::where('jenis', 'service')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return response()->json($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  Barang::where('jenis', 'barang')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return response()->json($data);
    }
}
