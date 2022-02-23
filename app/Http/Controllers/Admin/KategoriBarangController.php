<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Project;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class KategoriBarangController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product-access'), 403);

        $barangs = Barang::get();
        return view('admin.kategori-barang.index', compact('barangs'));
    }

    public function create(Barang $barangs)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $AWAL = 'KB';
        $noUrutAkhir = \App\Barang::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        return view('admin.kategori-barang.create', compact('barangs','nourut'));
    }

    public function store(StoreKategoriBarangRequest $request)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $request['durasi'] = 20 ;
        $request['is_active'] = 1 ;

        $barangs =  Barang::create($request->all());

        $projects = Project::get();

        foreach ($projects as $project) {
            HargaProdukCabang::create([
                'barang_id' => $barangs->id,
                'project_id' => $project->id,
                'qty' => 0
            ]);
        }
        return redirect()->route('admin.kategori-barang.index')->with('success', 'Kategori Barang has been added');
    }


    public function edit(Barang $barangs)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        return view('admin.kategori-barang.edit', compact('barangs'));
    }

    public function update(UpdateBarangRequest $request, Barang $barangs)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        $barangs->update($request->all());

        return redirect()->route('admin.kategori-barang.index')->with('success', 'Kategori Barang has been updated');
    }

    public function destroy(Barang $barangs)
    {
        abort_unless(\Gate::allows('product-delete'), 403);

        $barangs->delete();
        return redirect()->route('admin.kategori-barang.index')->with('success', 'Kategori Barang has been deleted');
    }
}
