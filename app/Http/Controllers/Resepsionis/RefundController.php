<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Pembatalan;
use App\Pembayaran;
use App\Refund;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $getno = request()->get('no_pembatalan');
        $batal = Pembatalan::orderBy('id', 'desc')->get();
        if ($getno) {

            $singlebatal = Pembatalan::where('no_pembatalan', $getno)->first();
            $idspr = $singlebatal->spr_id;

            $rincianid = Tagihan::where('id_spr', $idspr)->first();
            $getrincianid = $rincianid->id_rincian;

            $singlebayar = Pembayaran::where('rincian_id', $getrincianid)->first();
            $notrs = $singlebatal->spr->no_transaksi;

           
            
            $totalbayar = Pembayaran::whereHas('rincian', function($r){
                $getno = request()->get('no_pembatalan');
                $singlebatal = Pembatalan::where('no_pembatalan', $getno)->first();
                $notrs = $singlebatal->spr->no_transaksi;
                
                $r->where('no_transaksi', $notrs);
                $r->whereIn('tipe', [2,3]);
            })->sum('nominal');
            
                
            // dd($contoh);
            
            $idbatal = $singlebatal->no_pembatalan;
            
            $refund = Refund::where('no_pembatalan', $getno)->first();
            if ($refund) {
                $idbatal1 = $refund->no_pembatalan;

                return view('resepsionis.refund.index', compact('batal', 'singlebatal', 'singlebayar', 'idbatal1' ,'totalbayar'));
            }else {
               $idbatal1 = '';
               return view('resepsionis.refund.index', compact('batal', 'singlebatal', 'singlebayar', 'idbatal1', 'totalbayar'));
            }
            

        } else {
            $batal = Pembatalan::orderBy('id', 'desc')->get();

            return view('resepsionis.refund.index', compact('batal'));

        }

    }

    function list() {
        $refund = Refund::orderBy('no_refund', 'desc')->get();

        // foreach ($refund as $rf) {
        //     $no = $rf->no_pembatalan;
        // }
        // $batal = Pembatalan::where('no_pembatalan', $no)->orderBy('no_pembatalan', 'desc')->first();

        return view('resepsionis.refund.list', compact('refund'));
    }

    public function updateStatus($id)
    {
        $refund = Refund::find($id);
        $refund->status = 'paid';
        $refund->save();

        $idbatal = $refund->pembatalan_id;

        $batal = Pembatalan::where('id', $idbatal)->first();
        $batal->refund = 'paid';
        $batal->save();

        return redirect()->back();
    }

    public function storeRefund(Request $request)
    {

        $tgl = Carbon::now()->format('d-m-Y');
        Refund::create([
            'no_refund' => $request->no_refund,
            'tanggal_refund' => $tgl,
            'no_pembatalan' => $request->no_pembatalan,
            'diajukan' => $request->diajukan,
            'total_refund' => $request->total_refund,
            'status' => 'unpaid',
            'pembatalan_id' => $request->pembatalan_id
        ]);

        return redirect('resepsionis/refund/list');
    }
}
