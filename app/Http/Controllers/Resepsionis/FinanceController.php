<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Rumah;
use App\Spr;
use App\Tagihan;

class FinanceController extends Controller
{
    public function index()
    {
        $bayar = Pembayaran::all();

        return view('resepsionis.payment.index', compact('bayar'));
    }

    public function ubahStatus($id)
    {
        $bayar = Pembayaran::find($id);
        $bayar->status_approval = 'paid';
        $bayar->save();

        $bayar = Pembayaran::select('nominal', 'rincian_id')
            ->where('id', $id)->first();

        $where = [
            // 'nominal' => $bayar->nominal,
            'id_rincian' => $bayar->rincian_id,
        ];

        $tagihan = Tagihan::where($where)->first();

        if ($bayar->nominal == $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'paid';
        } else {
            $tagihan->status_pembayaran = 'partial';
        }
        $tagihan->save();

        $spr = $tagihan->id_spr;
        $spr1 = Spr::where('id_transaksi', $spr)->first();
        $spr1->status_booking = 'paid';
        $spr1->save();

        $unit = $spr1->id_unit;
        $rumah = Rumah::where('id_unit_rumah', $unit)->first();
        $rumah->status_penjualan = 'Sold';
        $rumah->save();

        // return $bayar->nominal;

        return redirect()->back();
    }
}
