<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Pembatalan;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $batal = Pembatalan::all();
        return view('resepsionis.refund.index', compact('batal'));
    }
}
