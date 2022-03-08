@extends('layouts.master', ['title' => 'Tukar Faktur'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">List Tukar Faktur</h1>
    </div>

    <div class="col-sm-8 text-right m-b-20">
        <a href="{{ route('purchasing.tukarfaktur.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add List Tukar Faktur</a>
    </div>
</div>
<x-alert></x-alert>

<form action="{{ route('purchasing.tukarfaktur.index') }}" method="get">
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
                        <th>No Tukar Faktur</th>
                        <th>Tanggal Tukar Faktur</th>
                        <th>No Po</th>
                        <th>No Invoice</th>
                        <th>Total Item</th>
                        <th>Total Pembelian</th>
                        <th>Vendor</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tukar as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('purchasing.tukarfaktur.show', $purchase->id) }}">{{$purchase->no_faktur }}</a>
                        </td>
                        <td>{{ Carbon\Carbon::parse($purchase->tanggal_tukar_faktur)->format("d/m/Y H:i:s") }}</td>
                        <td>{{ $purchase->no_po_vendor }}</td>
                        <td>{{ $purchase->no_invoice }}</td>
                        <td>{{ \App\TukarFaktur::where('no_faktur', $purchase->no_faktur)->count() }}</td> 
                        <td>@currency($purchase->nilai_invoice)</td>
                        <td>{{ $purchase->nama }}</td>
                        <td>{{ $purchase->status_pembayaran }}</td>
                        <td>

                            <!-- <a href="{{ route('logistik.purchase.edit', $purchase->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> -->

                            <form action="{{ route('purchasing.tukarfaktur.destroy', $purchase->id) }}" method="post" style="display: inline;" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total : </td>
                        <td colspan="3"></td>
                        <td>@currency( request('from') && request('to') ? \App\TukarFaktur::whereBetween('tanggal_tukar_faktur', [Carbon\Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s'), Carbon\Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s')])->where('id_user',auth()->user()->id)->sum('nilai_invoice') : \App\TukarFaktur::where('id_user',auth()->user()->id)->sum('nilai_invoice') )</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
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