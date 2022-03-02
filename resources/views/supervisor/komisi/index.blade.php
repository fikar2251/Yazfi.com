@extends('layouts.master', ['title' => ' Komisi'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Rincian Komisi</h1>
    </div>
</div>

 <div class="row doctor-grid">
        @foreach ($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src=""
                                style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a
                            href="{{ url('supervisor/komisi/' . $u->id) }}">{{ $u->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $u->address }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
{{--
<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="appointments" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Appointment</th>
                        <th>Nama Pasien</th>
                        <th>Cabang</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu Booking</th>
                        <th>Status Kedatangan</th>
                        <th>Status Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#appointments').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/supervisor/komisi/ajax',
                get: 'get'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'booking',
                    name: 'booking'
                },
                {
                    data: 'pasien',
                    name: 'pasien'
                },
                {
                    data: 'cabang',
                    name: 'cabang'
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'tindakan',
                    name: 'tindakan'
                },
            ]
        })
    })
</script> --}}
@stop
