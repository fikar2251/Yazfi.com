<?php

namespace App\Http\Controllers\Logistik;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Project;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $products = HargaProdukCabang::groupBy('id')->get();
        return view('logistik.product.index', compact('products'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $projects = DB::table('projects')
            ->where('nama_project', 'like', "%" . $cari . "%")
            ->paginate();
        return view('logistik.product.index', ['projects' => $projects]);
    }
    public function show(Barang $product)
    {
        return view('logistik.product.show', compact('product'));
    }

    // public function index()
    // {
    //     $products = DB::table('barangs')
    //         ->leftJoin('harga_produk_cabangs', 'harga_produk_cabangs.barang_id', '=', 'barangs.id')
    //         ->select('barangs.nama_barang', 'barangs.kode_barang', 'barangs.id', 'harga_produk_cabangs.harga', 'harga_produk_cabangs.barang_id', 'harga_produk_cabangs.qty')
    //         ->get();
    //     return view('logistik.product.index', compact('products'));
    // }
}
