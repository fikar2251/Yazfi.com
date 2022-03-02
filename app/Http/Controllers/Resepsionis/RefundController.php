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
        $batal = Pembatalan::all();
        if ($getno) {

            $singlebatal = Pembatalan::where('no_pembatalan', $getno)->first();
            $idspr = $singlebatal->spr_id;

            $rincianid = Tagihan::where('id_spr', $idspr)->first();
            $getrincianid = $rincianid->id_rincian;

            $singlebayar = Pembayaran::where('rincian_id', $getrincianid)->first();

            $idbatal = $singlebatal->no_pembatalan;
            $refund = Refund::where('no_pembatalan', $idbatal)->first();
            $idbatalrefund = $refund->no_pembatalan;

            return view('resepsionis.refund.index', compact('batal', 'singlebatal', 'singlebayar', 'idbatal', 'idbatalrefund'));
        } else {
            $batal = Pembatalan::all();

            return view('resepsionis.refund.index', compact('batal'));

        }

    }

    function list() {
        $refund = Refund::all();

        foreach ($refund as $rf) {
            $no = $rf->no_pembatalan;
        }
        $batal = Pembatalan::where('no_pembatalan', $no)->first();

        return view('resepsionis.refund.list', compact('refund', 'batal'));
    }

    public function updateStatus($id)
    {
        $refund = Refund::find($id);
        $refund->status = 'paid';
        $refund->save();

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
        ]);

        return redirect()->back();
    }
}
