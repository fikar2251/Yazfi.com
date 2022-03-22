<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Komisi;
use App\Pembayaran;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $bayar = Pembayaran::where('status_approval', 'paid')->get();

        return view('resepsionis.payment.index', compact('bayar'));
    }

    public function komisiFinance()
    {
        $komisi = Komisi::orderBy('id', 'desc')->get();
        return view('resepsionis.komisi.index', compact('komisi'));
    }

    public function listPayment()
    {
        $bayar = Pembayaran::all();
        return view('resepsionis.payment.daftar', compact('bayar'));
    }

    public function storePayment(Request $request)
    {

        $status = $request->get('status');
        $itemid = $request->get('id');
        $count_status = count($status);

        for ($i = 0; $i < $count_status; $i++) {
            $change = Pembayaran::where('id', $itemid[$i])->first();

            $change->update([
                'status_approval' => $status[$i],
            ]);

            $tagihan = Tagihan::where('id_rincian', $change->rincian_id)->first();
            $bayar = Pembayaran::where('rincian_id', $change->rincian_id)->sum('nominal');
            $sum = (int) $bayar;

            if ($change->status_approval == 'paid') {
                # code...
                if ($change->nominal == $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'paid';
                } elseif ($change->nominal < $tagihan->jumlah_tagihan && $sum < $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'partial';
                } elseif ($sum == $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'paid';
                }
                $tagihan->save();

                $spr = $tagihan->id_spr;
                $spr1 = Spr::where('id_transaksi', $spr)->first();
                if ($tagihan->tipe == 1) {
                    $spr1->status_booking = 'paid';
                } elseif ($tagihan->tipe == 2) {
                    $spr1->status_dp = 'paid';
                }
                $spr1->save();

                $unit = $spr1->id_unit;
                $rumah = Rumah::where('id_unit_rumah', $unit)->first();
                $rumah->status_penjualan = 'Sold';
                $rumah->save();
            }

        }
        // dd($change);

        return redirect()->back();

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

        $rincianid = $bayar->rincian_id;
        $nominal = $bayar->nominal;
        $bayar1 = Pembayaran::where('rincian_id', $rincianid)->sum('nominal');
        $sum = (int) $bayar1;

        if ($bayar->nominal == $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'paid';
        } elseif ($bayar->nominal < $tagihan->jumlah_tagihan && $sum < $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'partial';
        } elseif ($sum == $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'paid';
        }
        $tagihan->save();

        $spr = $tagihan->id_spr;
        $spr1 = Spr::where('id_transaksi', $spr)->first();
        if ($tagihan->tipe == 1) {
            $spr1->status_booking = 'paid';
        } elseif ($tagihan->tipe == 2) {
            $spr1->status_dp = 'paid';
        }
        $spr1->save();

        $unit = $spr1->id_unit;
        $rumah = Rumah::where('id_unit_rumah', $unit)->first();
        $rumah->status_penjualan = 'Sold';
        $rumah->save();

        return redirect()->back();
    }

    public function updateKomisi($id)
    {
        $tglBayar = Carbon::now()->format('d-m-Y');
        $komisi = Komisi::find($id);
        $komisi->status_pembayaran = 'paid';
        $komisi->tanggal_pembayaran = $tglBayar;
        $komisi->save();

        return redirect()->back();
    }

}
