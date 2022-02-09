@extends('layouts.master', ['title' =>'Report Komisi'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Report Komisi</h4>
    </div>
</div>

<form action="{{ route('admin.report.komisi') }}" method="post">
    @csrf
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus focused">
                <label class="focus-label">Pegawai</label>
                <select name="pegawai" class="select floating select2" tabindex="-1" aria-hidden="true">
                    <option disabled selected>Select Pegawai</option>
                    <option {{ request('pegawai') == 'all' ? 'selected' : '' }} value="all">Semua Pegawai</option>
                    @foreach($users as $user)
                    <option {{ request('pegawai') == $user->id ? 'selected' : '' }} value="{{ $user->id }}" required>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">From</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="from" required value="{{ \Carbon\Carbon::parse($from)->format('d/m/Y') ?? '' }}">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">To</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="to" required value="{{ \Carbon\Carbon::parse($to)->format('d/m/Y') ?? '' }}">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-success btn-block">Search</button>
        </div>
    </div>
</form>

@include('admin.report.komisi.table')

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
                title: 'Laporan Komisi {{ $rl ? " Pegawai " . $rl : "Semua Pegawai" }}',
                messageTop: 'Tanggal {{ $from }}  -  {{ $to }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Komisi {{ $rl ? "Pegawai " . $rl : "Semua Pegawai" }}',
                messageTop: 'Tanggal {{ $from }}  -  {{ $to }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop