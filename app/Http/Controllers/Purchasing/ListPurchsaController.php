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
use Carbon\Carbon;

class ListPurchsaController extends Controller
{
    public function index(Request $request)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $purchases = Purchase::groupBy('invoice')->whereBetween('created_at', [$from, $to])->get();
        } else {
            $purchases = DB::table('purchases')
            ->leftJoin('penerimaan_barangs','purchases.id','=','penerimaan_barangs.id_purchase')
            ->leftJoin('users','purchases.user_id','=','users.id')
            ->select('penerimaan_barangs.no_po','purchases.id','users.name','penerimaan_barangs.status_tukar_faktur','purchases.invoice','purchases.created_at','purchases.grand_total','penerimaan_barangs.grandtotal')
            ->groupBy('purchases.invoice')
            ->orderBy('purchases.id','desc')->get();
        }
        // $purchases = Purchase::groupBy('invoice')
        // ->orderBy('id','desc')->get();
        return view('purchasing.listpurchase.index', compact('purchases'));
    }

    public function show(Barang $product)
    {
        return view('purchasing.listpurchase.show', compact('product'));
    }
}
