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
        $('#payment').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "/resepsionis/payment/json",
            columns: [        
                {
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