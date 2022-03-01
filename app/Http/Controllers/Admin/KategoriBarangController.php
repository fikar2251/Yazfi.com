<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Project;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Requests\UpdateKategoriBarangRequest;
use App\KategoriBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product-access'), 403);

        $kategoris = KategoriBarang::select('id','nama_kategori')->OrderBy('created_at','desc')->get();
        return view('admin.kategoribarang.index', compact('kategoris'));
    }

    public function create(KategoriBarang $kategori)
    {
        abort_unless(\Gate::allows('product-create'), 403);
        return view('admin.kategoribarang.create', compact('kategori'));
    }

    public function store(StoreKategoriBarangRequest $request)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $request['is_active'] = 1 ;

        KategoriBarang::create($request->all());

        return redirect()->route('admin.kategoribarang.index')->with('success', 'Kategori Barang has been added');
    }

    public function edit(KategoriBarang $kategori)
    {

        abort_unless(\Gate::allows('product-edit'), 403);
        return view('admin.kategoribarang.edit', compact('kategori'));
    }

    public function update(UpdateKategoriBarangRequest $request, KategoriBarang $kategori)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        $kategori->update($request->all());

        return redirect()->route('admin.kategoribarang.index')->with('success', 'Kategori Barang has been updated');
    }

    public function destroy(KategoriBarang $kategori)
    {
    
        abort_unless(\Gate::allows('product-delete'), 403);

        $kategori->delete();
  
     
        return redirect()->route('admin.kategoribarang.index')->with('success', 'Kategori Barang has been deleted');
    }
}
