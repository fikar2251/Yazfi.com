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
    $(document).ready(function () {
        $.noConflict();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#pembatalans thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#pembatalans thead');

        var table = $('#pembatalans').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function () {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function (e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value +
                                            ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },

            ajax: {
                url: '/admin/ajax/ajax_pembatalan',
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
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp.')
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

            ],


        })
    })

</script>
@stop
