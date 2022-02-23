@extends('layouts.master', ['title' => 'Divisi'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Master Divisi</h4>
    </div>
    <div class="col-sm-8 text-right m-b-20">
        @can('divisi-create')
        <a href="{{ route('hrd.divisi.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Divisi</a>
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
                        <th>Kode Cabang</th>
                        <th>Nama Cabang</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Whatsapp</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cabangs as $cabang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $cabang->kode_cabang }}</td>
                        <td><a href="{{ route('admin.cabang.show', $cabang->id) }}">{{ $cabang->nama }}</a></td>
                        <td>{{ $cabang->alamat }}</td>
                        <td>{{ $cabang->telpon }}</td>
                        <td>{{ $cabang->email }}</td>
                        <td>{{ $cabang->wa }}</td>
                        <td>
                            <a href="/admin/cabang/{{ $cabang->id }}/ruangan" class="btn btn-sm btn-success"><i class="fa fa-home"></i></a>
                            @can('cabang-edit')
                            <a href="{{ route('admin.cabang.edit', $cabang->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('cabang-delete')
                            <form action="{{ route('admin.cabang.destroy', $cabang->id) }}" method="post" style="display: inline;" class="delete-form">
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