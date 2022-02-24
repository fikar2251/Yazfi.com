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

        $bayar = Pembayaran::select('rincian_id')
            ->where('id', $id)->get();

        foreach ($bayar as $byr) {
            $by = $byr->rincian_id;
        }

        $tagihan = Tagihan::where('id_rincian', $by)->first();
        $tagihan->status_pembayaran = 'paid';
        $tagihan->save();
        // dd($tagihan);

        return redirect()->back();
    }
}
