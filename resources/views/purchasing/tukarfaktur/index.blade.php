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
                    <tr style="font-size:12px;">
                        <th>No</th>
                        <th>No Tukar Faktur</th>
                        <th>Po / Spk</th>
                        <th>Tanggal Tukar Faktur</th>
                        <th>No Po</th>
                        <th>No Invoice</th>
                        {{-- <th>Vendor</th> --}}
                        <th>Total Item</th>
                        <th>Total Pembelian</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
             
                $array_no_po = [];
                @endphp

                <tbody>
                    @foreach($tukar as $purchase)
                    <tr style="font-size:12px;">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('purchasing.tukarfaktur.show', $purchase->id) }}">{{$purchase->no_faktur }}</a>
                        </td>
                        <td> <div class="d-flex justify-content-center mt-2">
                            @if($purchase->po_spk == '1')
                            <span class="custom-badge status-orange">PO</span>
                            @endif
                            @if($purchase->po_spk == '2')
                            <span class="custom-badge status-green">SPK</span>
                            @endif
                        </div></td>
                        <td>{{ Carbon\Carbon::parse($purchase->tanggal_tukar_faktur)->format("d/m/Y") }}</td>
                        <td> @php
                            array_push($array_no_po,  $purchase->no_po_vendor);
                            @endphp
                            </td>
                        
                        <td>{{ $purchase->no_invoice }}</td>
                        {{-- <td>{{ $purchase->nama }}</td> --}}
                        <td>{{ \App\TukarFaktur::where('no_faktur', $purchase->no_faktur)->count() }}</td> 
                        <td>@currency($purchase->nilai_invoice)</td>
                        <td>
                            <div class="d-flex justify-content-center mt-2">
                                @if($purchase->status_pembayaran == 'pending')
                                <span class="custom-badge status-orange">pending</span>
                                @endif
                                @if($purchase->status_pembayaran == 'completed')
                                <span class="custom-badge status-green">completed</span>
                                @endif
                            </div>
                        </td>
                       {{-- @if($status->count())

                             <td> Result Not Found</td>
                       @else --}}
                       
                       <td>

                            <!-- <a href="{{ route('logistik.purchase.edit', $purchase->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> -->

                            <form action="{{ route('purchasing.tukarfaktur.destroy', $purchase->id) }}" method="post" style="display: inline;" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        {{-- @endif --}}
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size:12px;">
                        <td>Total : </td>
                        <td colspan="5"></td>
                        <td>{{ request('from') && request('to') ? \App\TukarFaktur::whereBetween('tanggal_tukar_faktur', [Carbon\Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d'), Carbon\Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s')])->where('id_user',auth()->user()->id)->count() : \App\TukarFaktur::where('id_user',auth()->user()->id)->count() }}</td>
                     
                        <td>@currency( request('from') && request('to') ? \App\TukarFaktur::whereBetween('tanggal_tukar_faktur', [Carbon\Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d'), Carbon\Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d')])->where('id_user',auth()->user()->id)->sum('nilai_invoice') :   \App\TukarFaktur::where('id_user',auth()->user()->id)->sum('nilai_invoice') )</td>
                      
                        <td>&nbsp;</td>
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