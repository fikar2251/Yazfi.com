@extends('layouts.master', ['title' => 'Konfirmasi Bayar'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Konfirmasi Bayar </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="payment" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 15%">No Transaksi</th>
                                    <th style="width: 15%">Tanggal pembayaran</th>
                                    <th>Tipe</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Bank tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->no_detail_transaksi }}</td>
                                        <td>{{ $item->tanggal_pembayaran }}</td>
                                        <td>
                                           {{$item->rincian->keterangan}}
                                        </td>
                                        <td>
                                            @currency($item->nominal)
                                        </td>
                                        <td>
                                            @if ($item->status_approval == 'pending')
                                                <span class="custom-badge status-red">{{ $item->status_approval }}</span>
                                            @elseif ($item->status_approval == 'paid')
                                                <span class="custom-badge status-green">{{ $item->status_approval }}</span>
                                            @endif
                                        </td>
                                        <td style="width: 110px" class="text-center">
                                            @if ($item->bank_tujuan == 'Bri')
                                                BRI
                                            @elseif ($item->bank_tujuan == 'Bca')
                                                BCA
                                            @else
                                                Mandiri
                                            @endif
                                        </td> --}}
                                {{-- <td>
                                            <div class="text-center">
                                                <a href="{{ route('resepsionis.payment.status', $item->id) }}">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </a>
                                            </div>
                                        </td> --}}
                                {{-- </tr>
                                @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.dataTables.min.css">

    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    {{-- <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> --}}
    <script>
        $(function() {
            $('#payment thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#payment thead');

            $('#payment').DataTable({
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                fixedHeader: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input class="form-control" type="text" placeholder="' +
                                title + '" style="width: 100%"/>');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
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
                order: [
                    [0, 'desc']
                ],
                ajax: "/finance/payment/json",
                columns: [{
                        data: 'no_detail_transaksi',
                        name: 'no_detail_transaksi',
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'nominal',
                        name: 'nominal',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'status_approval',
                        name: 'status_approval',


                    },

                    {
                        data: 'bank_tujuan',
                        name: 'bank_tujuan',
                    },
                ]
            });
        });
    </script>
@stop
