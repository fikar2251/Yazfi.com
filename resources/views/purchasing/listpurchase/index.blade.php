@extends('layouts.master', ['title' => 'List Purchase'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">List Purchase</h1>
    </div>
</div>
<x-alert></x-alert>
<form action="{{ route('purchasing.listpurchase.index') }}" method="get">
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
                        <th>Total Item</th>
                        <th>Jumlah</th>
                        <th>Jumlah Bayar</th>
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
                        <td>{{ $purchase->name }}</td>
                        <td>{{ Carbon\Carbon::parse($purchase->created_at)->format("d/m/Y H:i:s") }}</td>
                        <td>{{ \App\Purchase::where('invoice', $purchase->invoice)->count() }}</td> 
                        <td>@currency ($purchase->grand_total)</td>
                        <td>@currency ($purchase->grandtotal)</td>
{{--                   
                        <td>@currency(\App\PenerimaanBarang::where('no_po', $purchase->no_po)->sum('grandtotal'))</td> --}}
                        <td> <div class="d-flex justify-content-center mt-2">
                            @if(\App\Purchase::where('invoice', $purchase->invoice)->sum('grand_total') != \App\PenerimaanBarang::where('no_po', $purchase->no_po)->sum('grandtotal'))
                            <span class="custom-badge status-orange">Belum Lunas</span>
                            @endif
                            @if(\App\Purchase::where('invoice', $purchase->invoice)->sum('grand_total')  == \App\PenerimaanBarang::where('no_po', $purchase->no_po)->sum('grandtotal'))
                            <span class="custom-badge status-green">Lunas</span>
                            @endif
                        </div>
                        </td>
                        {{-- <td>{{ $purchase->status_barang }}</td>
                        <td>{{ $purchase->status_pembayaran }}</td> --}}
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