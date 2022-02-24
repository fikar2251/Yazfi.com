<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Spr;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->distinct()->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();  

        return view('supervisor.payment.index', compact('spr', 'getSpr', 'tagihan', 'bayar'));
    }

    public function nominal(Request $request)
    {
        $no = request()->get('no_transaksi');

        $where = [
            'id_rincian' => $request->rincian_id,
        ];

        $data = DB::table('rincian_tagihan_spr')
            ->select('rincian_tagihan_spr.id_rincian', 'rincian_tagihan_spr.jumlah_tagihan')
            ->groupBy('rincian_tagihan_spr.jumlah_tagihan', 'rincian_tagihan_spr.id_rincian')
            ->where($where)->get();

        return $data;
    }

    public function storeBayar(Request $request)
    {
        $tgl = Carbon::now()->format('d-m-Y');
        Pembayaran::create([
            'id_admin' => auth()->user()->id,
            'no_detail_transaksi' => $request->no_transaksi,
            'tanggal_transaksi' => $tgl,
            'rincian_id' => $request->rincian_id,
            'nominal' => $request->nominal,
            'bank_tujuan' => $request->bank_tujuan,
            'id_perusahaan' => '1',
            'status_approval' => 'pending',
        ]);

        return redirect()->back();

    }

    public function hapuskonfirmasi($id)
    {
        DB::table('pembayaran_unit')->where('id', $id)->delete();
        return redirect()->back();
    }
}
