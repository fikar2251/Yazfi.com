@extends('layouts.master', ['title' => 'Komisi'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Komisi</h1>

        <x-alert></x-alert>

        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Master Komisi</h5>
            </div>

            <div class="card-body">
                @can('roles-create')
                <a href="{{ route('admin.komisi.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Komisi</a>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Role</th>
                                <th>Persentase</th>
                                <th>Min Transaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($komisi as $kms)
                            <tr>
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kms->role->key }}</td>
                                <td>{{ $kms->persentase }}</td>
                                <td>{{ $kms->min_transaksi }}</td>
                                <td>
                                    @can('roles-edit')
                                    <a href="{{ route('admin.komisi.edit', $kms->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('roles-delete')
                                    <form action="{{ route('admin.komisi.destroy', $kms->id) }}" method="post" style="display: inline;" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
    </div>
</div>
@stop