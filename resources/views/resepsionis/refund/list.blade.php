@extends('layouts.master', ['title' => 'List Refund'])
@section('content')

<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">List Refund </h4>
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
                            @foreach ($refund as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td>{{ $item->tanggal_refund }}</td>
                                <td>{{ $item->tanggal_pembayaran }}</td>
                                <td>
                                    {{$item->no_refund}}
                                </td>
                                <td>
                                    {{$item->no_pembatalan}}
                                </td>
                                <td>
                                    {{$item->pembatalan->spr->nama}}
                                </td>
                                <td>
                                    {{$item->pembatalan->spr->user->name}}
                                </td>
                                <td>
                                    {{$item->total_refund}}
                                </td>
                                <td>
                                    @if ($item->status == 'unpaid')
                                    <span class="custom-badge status-red">{{ $item->status }}</span>
                                    @elseif ($item->status == 'paid')
                                    <span class="custom-badge status-green">{{ $item->status }}</span>
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
