@extends('layouts.master', ['title' => 'Kategori Barang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Master Kategori Barang</h4>
    </div>
    <div class="col-sm-8 text-right m-b-20">
        @can('product-create')
        <a href="{{ route('admin.kategori-barang.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Kategori Barang</a>
        @endcan
    </div>
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>is_active</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($barangs as $barang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $barang->nama_barang }}
                        </td>
                        <td>{{ $barang->jenis }}</td>
                        <td>{{ $barang->is_active }}</td>
                        <td>
                            @can('product-edit')
                            <a href="{{ route('admin.kategori-barang.edit', $barang->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('product-delete')
                            <form action="{{ route('admin.kategori-barang.destroy', $barang->id) }}" method="post" style="display: inline;" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop