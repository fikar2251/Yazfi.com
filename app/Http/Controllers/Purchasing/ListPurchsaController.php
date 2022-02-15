<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Project;
use App\Purchase;

class ListPurchsaController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::groupBy('invoice')->get();
        return view('purchasing.listpurchase.index', compact('purchases'));
    }

    public function show(Barang $product)
    {
        return view('purchasing.listpurchase.show', compact('product'));
    }
}
