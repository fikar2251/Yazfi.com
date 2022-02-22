<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Spr;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->distinct()->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();

        foreach ($getSpr as $key) {
            $no = $key->no_transaksi;
        }

        // dd($no);

        return view('supervisor.payment.index', compact('spr', 'getSpr', 'tagihan'));
    }

    public function storeBayar(Request $request)
    {
        $no = request()->get('no_transaksi');

        $tgl = Carbon::now()->format('d-m-Y');
        Pembayaran::create([
            'id_admin' => auth()->user()->id,
            'no_detail_transaksi' => $request->no_transaksi,
            'tanggal_transaksi' => $tgl,
            'nominal' => $request->nominal,
            'id_perusahaan' => '1',
            'status_approval' => 'pending',
            'tujuan' => $request->tujuan,
        ]);

        return redirect()->route('supervisor.payment.index');

    }
}
