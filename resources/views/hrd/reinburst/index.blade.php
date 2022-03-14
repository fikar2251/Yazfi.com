@extends('layouts.master', ['title' => 'Reinburst'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Reinburst</h1>
    </div>
    @can('reinburst-create')
    <div class="col-sm-8 text-right m-b-20">
        <a href="{{ route('hrd.reinburst.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Reinburst</a>
    </div>
    @endcan
</div>
<x-alert></x-alert>

<form action="{{ route('hrd.reinburst.index') }}" method="get">
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
                        <th>Nomor Reinburst</th>
                        <th>Tanggal Reinburst</th>
                        <th>Total Item</th>
                        <th>Total Pembelian</th>
                        <th>Status Hrd</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($reinbursts as $reinburst)
                <tbody>
                  
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('purchasing.reinburst.show', $reinburst->id) }}">{{ $reinburst->nomor_reinburst }}</a></td>
                        <td>{{ Carbon\Carbon::parse($reinburst->tanggal_reinburst)->format("d/m/Y H:i:s") }}</td>
                        <td>{{ \App\Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->count() }}</td>
                        <td>@currency(\App\RincianReinburst::where('nomor_reinburst',
                            $reinburst->nomor_reinburst)->sum('total'))</td>
                                <td> <div class="d-flex justify-content-center mt-2">
                                    @if($reinburst->status_hrd == 'pending')
                                    <span class="custom-badge status-red">pending</span>
                                    @endif
                                    @if($reinburst->status_hrd == 'completed')
                                    <span class="custom-badge status-green">completed</span>
                                    @endif
                                    @if($reinburst->status_hrd == 'review')
                                    <span class="custom-badge status-orange">review</span>
                                    @endif
                                </div>
                            </td>
                            <td> <div class="d-flex justify-content-center mt-2">
                                @if($reinburst->status_pembayaran == 'pending')
                                <span class="custom-badge status-red">pending</span>
                                @endif
                                @if($reinburst->status_pembayaran == 'completed')
                                <span class="custom-badge status-green">completed</span>
                                @endif
                                @if($reinburst->status_pembayaran == 'review')
                                <span class="custom-badge status-orange">review</span>
                                @endif
                            </div>
                        </td>
                            
                        
                        <td>
                            @can('reinburst-edit')
                            <a href="{{ route('hrd.reinburst.edit', $reinburst->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('reinburst-delete')
                            <form action="{{ route('hrd.reinburst.destroy', $reinburst->id) }}" method="post" style="display: inline;" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total : </td>
                        <td colspan="2"></td>
                        <td>{{ request('from') && request('to') ? \App\Reinburst::whereBetween('tanggal_reinburst', [Carbon\Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s'), Carbon\Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s')])->where('id_user',auth()->user()->id)->count() : \App\Reinburst::where('id_user', auth()->user()->id)->get()->count() }}</td>
                        <td>@currency( request('from') && request('to') ? $coba :  DB::table('rincian_reinbursts')->leftjoin('reinbursts','rincian_reinbursts.nomor_reinburst','=','reinbursts.nomor_reinburst')->where('reinbursts.id_user',auth()->user()->id)->sum('rincian_reinbursts.total')  )</td>
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