@extends('layouts.master', ['title' => 'Customer'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title"></h1>
    </div>
</div>
<form action="{{ route('admin.customer.index') }}" method="get">
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

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report" width="100%" id="customers">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Nama Customer</th>
                        <th>No KTP</th>
                        <th>No Telepon</th>
                        <th>Unit</th>
                        <th>Blok</th>
                        <th>No</th>
                        <th>Harga Jual</th>
                        <th>Tanggal Transaksi</th>
                        <!-- <th>Action</th> -->
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
        $('#customers').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/customer/ajax',
                get: 'get'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_transaksi',
                    name: 'no_transaksi'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'no_ktp',
                    name: 'no_ktp'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: 'blok',
                    name: 'blok'
                },
                {
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'harga_net',
                    name: 'harga_net',
                    render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp.' )
                },
                {
                    data: 'tanggal_transaksi',
                    name: 'tanggal_transaksi'
                },
            ]
        })
    })
</script>
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
                title: 'Laporan Customer ',
                messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Customer ',
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