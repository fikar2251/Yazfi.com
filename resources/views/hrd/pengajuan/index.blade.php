@extends('layouts.master', ['title' => 'Pengajuan Dana'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Pengajuan Dana</h1>
    </div>
    @can('pengajuan-create')
    <div class="col-sm-8 text-right m-b-20">
        <a href="{{ route('logistik.pengajuan.create') }}" class="btn btn btn-primary btn-rounded float-right"><i
                class="fa fa-plus"></i> Add Pengajuan</a>
    </div>
    @endcan
</div>
<x-alert></x-alert>

<form action="{{ route('logistik.pengajuan.index') }}" method="get">
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
                        <th>No Pengajuan</th>
                        <th>Perusahaan</th>
                        <th>Tanggal</th>
                        <th>Divisi</th>
                        <th>Nama</th>
                        <th>Total Item</th>
                        <th>Total Pembelian</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pengajuans as $peng)
                    <tr style="font-size:13px;">
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('logistik.pengajuan.show', $peng->id) }}">{{ $peng->nomor_pengajuan }}</a>
                        </td>

                        <td>{{$peng->perusahaan->nama_perusahaan }}</td>
                        <td>{{ Carbon\Carbon::parse($peng->tanggal_pengajuan)->format("d/m/Y") }}</td>
                        <td>{{ $peng->roles->name }}</td>
                        <td>{{ $peng->admin->name }}</td>
                        <td>{{ \App\RincianPengajuan::where('nomor_pengajuan', $peng->nomor_pengajuan)->count() }}</td>
                        <td>@currency(\App\RincianPengajuan::where('nomor_pengajuan',
                            $peng->nomor_pengajuan)->sum('total'))</td>

                        <td>
                            <div class="d-flex justify-content-center mt-2">
                                @if($peng->status_approval == 'pending')
                                <span class="custom-badge status-red">pending</span>
                                @endif
                                @if($peng->status_approval == 'completed')
                                <span class="custom-badge status-green">completed</span>
                                @endif
                            </div>
                        </td>
                        @can('pengajuan-edit')
                        <td>
                        <a href="{{ route('logistik.pengajuan.edit', $peng->id) }}" class="btn btn-sm btn-info"><i
                                class="fa fa-edit"></i></a>
                        @endcan
                        @can('pengajuan-delete')
                        <form action="{{ route('logistik.pengajuan.destroy', $peng->id) }}" method="post"
                            style="display: inline;" class="delete-form">
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
                        <td colspan="5"></td>
                        <td>{{ request('from') && request('to') ? \App\Pengajuan::whereBetween('tanggal_pengajuan', [Carbon\Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s'), Carbon\Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s')])->where('id_user',auth()->user()->id)->count() : \App\Pengajuan::where('id_user',auth()->user()->id)->count() }}
                        </td>
                        <td>@currency( request('from') && request('to') ? $coba :
                            DB::table('rincian_pengajuans')->leftjoin('pengajuans','rincian_pengajuans.nomor_pengajuan','=','pengajuans.nomor_pengajuan')->where('pengajuans.id_user',auth()->user()->id)->sum('rincian_pengajuans.grandtotal')
                            )</td>
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
