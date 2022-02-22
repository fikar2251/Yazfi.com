@extends('layouts.master', ['title' =>'Report Appointment'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Report Appointment</h4>
    </div>
</div>

<form action="{{ route('admin.report.appointment') }}" method="post">
    @csrf
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus focused">
                <label class="focus-label">Cabang</label>
                <select name="cabang" class="select floating select2" tabindex="-1" aria-hidden="true">
                    <option disabled selected>Select Cabang</option>
                    <option {{ request('cabang') == 'all' ? 'selected' : '' }} value="all">Semua Cabang</option>
                    @foreach($cabang as $cab)
                    <option {{ request('cabang') == $cab->id ? 'selected' : '' }} value="{{ $cab->id }}" required>{{ $cab->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

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

@include('admin.report.appoinment.table')

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
                title: 'Laporan Appointment {{ $cb ? "Cabang " . $cb->nama : "Semua Cabang" }}',
                messageTop: 'Tanggal {{ $from }}  -  {{ $to }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Appointment {{ $cb ? "Cabang " . $cb->nama : "Semua Cabang" }}',
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