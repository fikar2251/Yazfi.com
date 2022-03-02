@extends('layouts.master', ['title' => 'Pembatalan Unit'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Pembatalan Unit</h1>
    </div>
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="pembatalans" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pembatalan</th>
                        <th>Tanggal</th>
                        <th>Type</th>
                        <th>Spr</th>
                        <th>Total Beli</th>
                        <th>Konsumen</th>
                        <th>Sales</th>
                        <th>Booking Fee</th>
                        <th>DP</th>
                        <th>Diajukan</th>
                        <th>Status</th>
                        <th>Refund</th>
                        <th>Action</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
       $.noConflict();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#pembatalans').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/pembatalans/ajax',
                get: 'get'

            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_pembatalan',
                    name: 'no_pembatalan'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'spr',
                    name: 'spr'
                },
                {
                    data: 'total_beli',
                    name: 'total_beli',
                    render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp.' )
                },
                {
                    data: 'konsumen',
                    name: 'konsumen'
                },
                {
                    data: 'sales',
                    name: 'sales'
                },
                {
                    data: 'booking_fee',
                    name: 'booking_fee'
                },
                {
                    data: 'dp',
                    name: 'dp'
                },
                {
                    data: 'diajukan',
                    name: 'diajukan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'refund',
                    name: 'refund'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]

        })
    })
</script>
@stop
