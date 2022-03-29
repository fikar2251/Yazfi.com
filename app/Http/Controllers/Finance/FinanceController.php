<?php
namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Komisi;
use App\Pembayaran;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FinanceController extends Controller
{
    public function index()
    {
        $bayar = Pembayaran::where('status_approval', 'paid')->get();

        return view('finance.payment.index', compact('bayar'));
    }

    public function paymentJson()
    {
        $bayar = Pembayaran::where('status_approval', 'paid')->get();

        return DataTables::of($bayar)
                ->editColumn('status_approval', function($bayar){
                    if ($bayar->status_approval == 'pending'){
                    return '<span class="badge badge-danger">' . $bayar->status_approval . '</span>';
                    }elseif ($bayar->status_approval == 'paid'){
                    return '<span class="badge status-green">' . $bayar->status_approval. '</span>';
                    }
                })
                ->editColumn('bank_tujuan', function($bayar){
                    if ($bayar->bank_tujuan == 'Bri'){
                    return 'BRI';
                    }elseif ($bayar->bank_tujuan == 'Bca'){
                    return 'BCA';
                    }else {
                        return 'Mandiri';
                    }
                })
                ->editColumn('keterangan', function($bayar){
                    return $bayar->rincian->keterangan;
                })
                ->addIndexColumn()
                ->rawColumns(['status_approval', 'bank_tujuan', 'keterangan'])
                ->make(true);
    }

    public function komisiFinance()
    {
        $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', 'paid')->get();
        return view('finance.komisi.index', compact('komisi'));
    }

    public function komisiJson()
    {
        $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', 'paid')->get();

        
        return DataTables::of($komisi)
        ->editColumn('status_pembayaran', function($komisi){
            if ($komisi->status_pembayaran == 'unpaid'){
            return '<span class="badge badge-danger">' . $komisi->status_pembayaran . '</span>';
            }elseif ($komisi->status_pembayaran == 'paid'){
            return '<span class="badge status-green">' . $komisi->status_pembayaran. '</span>';
            }
        })
        ->addIndexColumn()
        ->rawColumns(['status_pembayaran'])
        ->make(true);
    }

    public function listKomisi(Request $request)
    {
        $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', ['unpaid','reject'])->get();
        return view('finance.komisi.daftar', compact('komisi'));
    }

    public function storeKomisi(Request $request)
    {
        $status = $request->get('status');
        $itemid = $request->get('id');
        $count_status = count($status);

        for ($i=0; $i <$count_status ; $i++) { 
            $change = Komisi::where('id', $itemid[$i])->first();

            $change->update([
                'status_pembayaran' => $status[$i],
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
            ]);
        }
        return redirect()->back();
    }

    public function listPayment()
    {
        $bayar = Pembayaran::where('status_approval', ['pending', 'reject'])->get();
        return view('finance.payment.daftar', compact('bayar'));
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
