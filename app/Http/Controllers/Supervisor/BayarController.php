<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Spr;
use App\Tagihan;
use Illuminate\Http\Request;


class BayarController extends Controller
{
    public function index(Request $request)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->distinct()->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();

        return view('supervisor.payment.index', compact('spr', 'getSpr', 'tagihan'));
    }
}
