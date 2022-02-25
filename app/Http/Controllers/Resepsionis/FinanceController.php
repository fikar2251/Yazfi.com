<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Pembayaran;
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
        // return $bayar->nominal;

        return redirect()->back();
    }
}
