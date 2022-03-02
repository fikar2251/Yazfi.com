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
                                    <th>Tanggal</th>
                                    <th>No Refund</th>
                                    <th>No Pembatalan</th>
                                    <th>Konsumen</th>
                                    <th>Sales</th>
                                    <th>Total refund</th>
                                    <th>Pembayaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refund as $item)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        <td>
                                            {{$item->no_refund}}
                                        </td>
                                        <td>
                                            {{$item->no_pembatalan}}
                                        </td>
                                        <td>
                                            {{$batal->spr->nama}}
                                        </td>
                                        <td >
                                            {{$batal->spr->user->name}}
                                        </td>
                                        <td>
                                            {{$item->total_refund}}
                                        </td>
                                        <td>
                                            @if ($item->status == 'unpaid')
                                                <span class="btn-danger">{{ $item->status }}</span>
                                            @elseif ($item->status == 'paid')
                                                <span class="btn-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('resepsionis.refund.update', $item->id)}}">
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
