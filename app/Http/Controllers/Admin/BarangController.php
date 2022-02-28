<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Project;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\KategoriBarang;

class BarangController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product-access'), 403);

        $products = Barang::OrderBy('created_at','desc')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create(Barang $product)
    {
        abort_unless(\Gate::allows('product-create'), 403);
        $AWAL = 'KB';
        $noUrutAkhir = \App\Barang::max('id');
        // dd($noUrutAkhir);
        $nourut  = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));

        $kategoris = KategoriBarang::get();
        return view('admin.product.create', compact('kategoris','nourut','product'));
    }

    public function store(StoreBarangRequest $request)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $attr['durasi'] = 20;
        $attr['type'] = 1;
        $attr['is_active'] = 1;
        $attr['id_jenis'] = 1;
       $barangs= Barang::create($request->all());

        $projects = Project::get();

        foreach ($projects as $project) {
            HargaProdukCabang::create([
                'barang_id' => $barangs->id,
                'project_id' => $project->id,
                'qty' => 0
            ]);
        }
        return redirect()->route('admin.product.index')->with('success', 'Product has been added');
    }

    public function show(Barang $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Barang $product)
    {
        abort_unless(\Gate::allows('product-edit'), 403);
        $kategoris = KategoriBarang::get();

        return view('admin.product.edit', compact('product','kategoris'));
    }

    public function update(UpdateBarangRequest $request, Barang $product)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        $product->update($request->all());

        return redirect()->route('admin.product.index')->with('success', 'Product has been updated');
    }

    public function destroy(Barang $product)
    {
        abort_unless(\Gate::allows('product-delete'), 403);

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product has been deleted');
    }
}
