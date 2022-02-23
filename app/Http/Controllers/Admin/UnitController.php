<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\{Cabang, Unit, HargaProdukCabang, Perusahaan, Ruangan};

class UnitController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product-access'), 403);

        $units = Unit::get();
        return view('admin.unit.index', compact('units'));
    }

    public function create(Unit $unit)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $perusahaans = Perusahaan::get();

        return view('admin.unit.create', compact('unit','perusahaans'));
    }

    public function store(StoreWarehouseRequest $request)
    {
        // abort_unless(\Gate::allows('product-create'), 403);

        $request['nama'] = request('nama');
        $request['id_perusahaan'] = request('id_perusahaan');
        Unit::create($request->all());

        return redirect()->route('admin.unit.index')->with('success', 'Unit has been added');
    }

    public function edit(Unit $unit)
    {
        abort_unless(\Gate::allows('cabang-edit'), 403);
        $perusahaans = Perusahaan::get();

        return view('admin.unit.edit', compact('unit','perusahaans'));
    }

    public function update(UpdateWarehouseRequest $request, Unit $unit)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        $request['nama'] = request('nama');
        $request['id_perusahaan'] = request('id_perusahaan');

        $unit->update($request->all());

        return redirect()->route('admin.unit.index')->with('success', 'Unit has been updated');
    }

    public function destroy(Unit $unit)
    {
        abort_unless(\Gate::allows('product-delete'), 403);

        $unit->delete();

        return redirect()->route('admin.unit.index')->with('success', 'Unit has been deleted');
    }
}
