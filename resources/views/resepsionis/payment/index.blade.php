@extends('layouts.master', ['title' => 'Konfirmasi Bayar'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Konfirmasi Bayar </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-11">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped">
                            <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Tanggal transaksi</th>
                                    <th>Tipe</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Bank tujuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->no_detail_transaksi }}</td>
                                        <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        <td>
                                           {{$item->rincian->keterangan}}
                                        </td>
                                        <td>
                                            @currency($item->nominal)
                                        </td>
                                        <td>
                                            @if ($item->status_approval == 'pending')
                                                <span class="btn-danger">{{ $item->status_approval }}</span>
                                            @elseif ($item->status_approval == 'paid')
                                                <span class="btn-success">{{ $item->status_approval }}</span>
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
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{ route('resepsionis.payment.status', $item->id) }}">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </a>
                                            </div>
                                        </td>
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
