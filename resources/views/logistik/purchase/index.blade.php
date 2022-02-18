@extends('layouts.master', ['title' => 'Purchase'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Purchase</h1>
    </div>

    <div class="col-sm-8 text-right m-b-20">
        <a href="{{ route('logistik.purchase.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Purchase</a>
    </div>
</div>
<x-alert></x-alert>

<form action="{{ route('logistik.purchase.index') }}" method="get">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">From</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="from" required>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">To</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="to" required>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-success btn-block">Search</button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Di Ajukan</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Status Barang</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('logistik.purchase.show', $purchase->id) }}">{{ $purchase->invoice }}</a>
                        </td>
                        <td>{{ $purchase->admin->name }}</td>
                        <td>{{ Carbon\Carbon::parse($purchase->created_at)->format("d/m/Y H:i:s") }}</td>
                        <td>@currency(\App\Purchase::where('invoice', $purchase->invoice)->sum('grand_total'))</td>
                        <td>{{ $purchase->status_barang }}</td>
                        <td>{{ $purchase->status_pembayaran }}</td>
                        <td>

                            <!-- <a href="{{ route('logistik.purchase.edit', $purchase->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> -->

                            <form action="{{ route('logistik.purchase.destroy', $purchase->id) }}" method="post" style="display: inline;" class="delete-form">
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
                title: 'Laporan Pembelian ',
                messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Pembelian ',
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