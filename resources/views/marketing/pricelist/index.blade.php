@extends('layouts.master', ['title' => 'List SPR'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar SPR </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="unit" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No Pesanan</th>
                                    <th>Konsumen</th>
                                    <th>No.KTP</th>
                                    <th>Harga Jual</th>
                                    <th>Type</th>
                                    <th>Luas LT/LB</th>
                                    <th>Booking Fee</th>
                                    <th>DP</th>
                                    <th>Skema Pembayaran</th>
                                    <th>Total Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($spr as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('marketing.pricelist.detail', $item->id_transaksi) }}">{{ $item->no_transaksi }}
                                            </a>
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td style="width: 130px">@currency($item->harga_jual)</td>
                                        <td>{{ $item->unit->type }}</td>
                                        <td>{{ $item->unit->total }}/{{ $item->unit->lb }}</td>
                                        <td>
                                            @if ($item->status_booking == 'unpaid')
                                                <span class="badge badge-danger">{{ $item->status_booking }}</span>
                                            @elseif ($item->status_booking == 'paid')
                                                <span class="badge status-green">{{ $item->status_booking }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_dp == 'unpaid')
                                                <span class="badge badge-danger">{{ $item->status_dp }}</span>
                                            @elseif ($item->status_dp == 'paid')
                                                <span class="badge status-green">{{ $item->status_dp }}</span>
                                            @endif
                                        </td>

                                        <td>{{ $item->skema_pembayaran->nama_skema }}</td>
                                        <td style="width: 120px"> @currency($item->harga_net)</td>
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
        $('#unit').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "/marketing/pricelist/json",
            columns: [{
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
                    data: 'harga_jual',
                    name: 'harga_jual',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'status_booking',
                    name: 'status_booking'
                },
                {
                    data: 'status_dp',
                    name: 'status_dp'
                },
                {
                    data: 'skema',
                    name: 'skema'
                },
                {
                    data: 'harga_net',
                    name: 'harga_net',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },
            ]
        });
    });
</script>
@stop
