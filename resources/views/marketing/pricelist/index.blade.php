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
                                    <th>NO</th>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_transaksi }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>@currency($item->harga_jual)</td>
                                        <td>{{ $item->unit->type }}</td>
                                        <td>{{ $item->unit->total }}/{{ $item->unit->lb }}</td>
                                        {{-- @foreach ($bf as $bfs) --}}
                                            <td>{{ $item->status_booking}}</td>
                                        {{-- @endforeach --}}

                                        {{-- @foreach ($dp as $dps) --}}
                                            <td>{{ $item->status_dp }}</td>
                                        {{-- @endforeach --}}
                                        <td>{{ $item->skema_pembayaran->nama_skema }}</td>
                                        <td> @currency($item->harga_jual)</td>
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
