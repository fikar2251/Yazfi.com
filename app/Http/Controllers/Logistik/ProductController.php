<?php

namespace App\Http\Controllers\Logistik;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('barangs')
            ->leftJoin('harga_produk_cabangs', 'barangs.id', '=  'harga_produk_cabangs.barang_id')
            ->select('nama_barang', 'kode_barang', 'id')
            ->get();
        return view('logistik.product.index', compact('products'));
    }
}
