@extends('layouts.master', ['title' => 'Master User'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Team Sales</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('hrd.sales.create') }}" class="btn btn btn-primary btn-rounded float-right"><i
                class="fa fa-plus"></i> Add Team Sales</a>

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
                        <th>Manager</th>
                        <th>Supervisor</th>
                        <th>Sales</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sale as $sales)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $sales->manager->name }}</td>
                        <td>{{ $sales->spv->name }}</td>
                        @foreach($coba as $cobas)
                        <td>{{ $cobas->id_sales }}</td>
                        @endforeach
                        {{-- <td>
                            <a href="{{ route('hrd.sales.edit', $sales->id) }}" class="btn btn-sm btn-info"><i
                            class="fa fa-edit"></i></a>
                        <form action="{{ route('hrd.sales.destroy', $sales->id) }}" method="post"
                            style="display: inline;" class="delete-form">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        </td> --}}
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
