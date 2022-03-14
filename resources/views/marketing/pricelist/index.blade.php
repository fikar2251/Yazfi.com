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
                        <table class="table table-bordered custom-table table-striped">
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
                                @foreach ($spr as $item)
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
                                                <span class="custom-badge status-red">{{ $item->status_booking }}</span>
                                            @elseif ($item->status_booking == 'paid')
                                                <span class="custom-badge status-green">{{ $item->status_booking }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_dp == 'unpaid')
                                                <span class="custom-badge status-red">{{ $item->status_dp }}</span>
                                            @elseif ($item->status_dp == 'paid')
                                                <span
                                                    class="custom-badge status-green">{{ $item->status_dp }}</span>
                                            @endif
                                        </td>

                                        <td>{{ $item->skema_pembayaran->nama_skema }}</td>
                                        <td style="width: 120px"> @currency($item->harga_net)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
