<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use App\User;
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

    public function show($id)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->where('id_sales', $id)->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        return view('supervisor.payment.create', compact('spr', 'getSpr', 'tagihan', 'bayar', 'id'));

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
        $check = Pembayaran::select('rincian_id')->where('id', $id)->first();
        $id_rincian = $check->rincian_id;
        $tagihan = Tagihan::where('id_rincian', $id_rincian)->first();
        $tagihan->status_pembayaran = 'unpaid';
        $tagihan->save();

        $idspr = $tagihan->id_spr;
        $spr = Spr::where('id_transaksi', $idspr)->first();
        $spr->status_booking = 'unpaid';
        $spr->save();

        $idunit = $spr->id_unit;
        $unit = Rumah::where('id_unit_rumah', $idunit)->first();
        $unit->status_penjualan = 'Available';
        $unit->save();
        // dd($test);


        // if ($delete) {
            DB::table('pembayaran_unit')->where('id', $id)->delete();
            // dd($tagihan);
        // }
        return redirect()->back();
    }
}
