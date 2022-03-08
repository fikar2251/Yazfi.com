@extends('layouts.master', ['title' => 'List Purchase'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">List Purchase</h1>
    </div>
</div>
<x-alert></x-alert>
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
                        <th>Total Item</th>
                        <th>Jumlah</th>
                        <th>Status Barang</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('purchasing.listpurchase.show', $purchase->id) }}">{{ $purchase->invoice }}</a>
                        </td>
                        <td>{{ $purchase->admin->name }}</td>
                        <td>{{ Carbon\Carbon::parse($purchase->created_at)->format("d/m/Y H:i:s") }}</td>
                        <td>{{ \App\Purchase::where('invoice', $purchase->invoice)->count() }}</td> 
                        <td>@currency(\App\Purchase::where('invoice', $purchase->invoice)->sum('total'))</td>
                        <td>{{ $purchase->status_barang }}</td>
                        <td>{{ $purchase->status_pembayaran }}</td>
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
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop