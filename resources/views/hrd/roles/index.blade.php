@extends('layouts.master', ['title' => 'Roles'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Roles</h1>
    </div>
    <div class="col-sm-8 text-right m-b-20">
        <a href="{{ route('hrd.roles.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Role</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Key Access</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->key }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('hrd.roles.show', $role->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('hrd.roles.edit', $role->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('hrd.roles.destroy', $role->id) }}" method="post" style="display: inline;" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop