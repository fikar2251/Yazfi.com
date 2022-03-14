@extends('layouts.master', ['title' => 'Pembatalan'])

@section('content')
    <div class="text-center">
        <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">PEMBATALAN UNIT</h4>
    </div>
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Sales</h4>
        </div>
    </div>

    <div class="row doctor-grid">
        @foreach ($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src=""
                                style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a
                            href="{{ url('supervisor/cancel/' . $u->id) }}">{{ $u->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $u->address }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Pembatalan</h4>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal transaksi</th>
                                    <th>No pembatalan</th>
                                    <th>Type</th>
                                    <th>Spr</th>
                                    <th>Total beli</th>
                                    <th>Konsumen</th>
                                    <th>Sales</th>
                                    {{-- <th>Booking Fee</th>
                                    <th>DP</th> --}}
                                    <th>Diajukan</th>
                                    <th>Status</th>
                                    <th>Refund</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batal as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td style="width: 100px">{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        <td> {{ $item->no_pembatalan }} </td>
                                        <td>
                                            {{ $item->spr->unit->type }}
                                        </td>
                                        <td>
                                            {{ $item->spr->no_transaksi }}
                                        </td>
                                        <td>
                                            @currency($item->spr->harga_net)
                                        </td>
                                        <td> {{ $item->spr->nama }} </td>
                                        <td> {{ $item->spr->user->name }} </td>
                                        {{-- <td> @currency($bf->jumlah_tagihan) </td>
                                        <td> @currency($dp->jumlah_tagihan) </td> --}}
                                        <td> {{ auth()->user()->name }} </td>
                                        <td> {{ $item->status }} </td>
                                        <td>
                                            @if ($item->refund == 'unpaid')
                                                <span class="custom-badge status-red">{{ $item->refund }}</span>
                                            @elseif ($item->refund == 'paid')
                                                <span class="custom-badge status-green">{{ $item->refund }}</span>
                                            @endif
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
