@extends('layouts.master', ['title' => 'Master User'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Team Sales</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('hrd.sales.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Team Sales</a>

    </div>
</div>
<x-alert></x-alert>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Supervisor</th>
                        <th>Sales</th>
                        <th>Manager</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $sale->spv->name }}</td>
                        <td><span class="custom-badge status-blue">{{ $sale->sales }}</span></td>
  
                        {{-- <td>
                            @foreach($sale->sales->name)
                            <span class="custom-badge status-blue">{{ $role }}</span>
                            @endforeach
                        </td> --}}
                        <td>{{ $sale->manager->name }}</td>
                        <td>
                            <a href="{{ route('hrd.sales.edit', $sale->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('hrd.sales.destroy', $sale->id) }}" method="post" style="display: inline;" class="delete-form">
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

@section('footer')
<script>
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-default',
                title: 'Laporan Team Sales ',
                messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Team Sales ',
                messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop