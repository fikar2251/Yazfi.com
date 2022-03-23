@extends('layouts.master', ['title' => 'List Refund'])
@section('content')

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Refund </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="refund" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>No Refund</th>
                                    <th>No Pembatalan</th>
                                    <th>Konsumen</th>
                                    <th>Sales</th>
                                    <th>Total refund</th>
                                    <th>Pembayaran</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($refund as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>{{ $item->tanggal_refund }}</td>
                                        <td>{{ $item->tanggal_pembayaran }}</td>
                                        <td>
                                            {{ $item->no_refund }}
                                        </td>
                                        <td>
                                            {{ $item->no_pembatalan }}
                                        </td>
                                        <td>
                                            {{ $item->pembatalan->spr->nama }}
                                        </td>
                                        <td>
                                            {{ $item->pembatalan->spr->user->name }}
                                        </td>
                                        <td>
                                            {{ $item->total_refund }}
                                        </td>
                                        <td>
                                            @if ($item->status == 'unpaid')
                                                <span class="custom-badge status-red">{{ $item->status }}</span>
                                            @elseif ($item->status == 'paid')
                                                <span class="custom-badge status-green">{{ $item->status }}</span>
                                            @endif
                                        </td>

                                    </tr>
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
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
        $(function() {
            $('#refund').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                ajax: "/resepsionis/refund/json",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'tanggal_refund',
                        name: 'tanggal_refund',
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                    },
                    {
                        data: 'no_refund',
                        name: 'no_refund',
                       
                    },
                    {
                        data: 'no_pembatalan',
                        name: 'no_pembatalan',


                    },

                    {
                        data: 'konsumen',
                        name: 'konsumen',
                    },
                    {
                        data: 'sales',
                        name: 'sales',
                    },
                    {
                        data: 'total_refund',
                        name: 'total_refund',
                    },
                    {
                        data: 'refund',
                        name: 'refund',
                    },
                ]
            });
        });
    </script>
@stop
