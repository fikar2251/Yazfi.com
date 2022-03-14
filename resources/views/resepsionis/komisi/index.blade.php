@extends('layouts.master', ['title' => 'Komisi'])
@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Komisi</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="appointments" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Komisi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>No SPR</th>
                        <th>Komisi Sales</th>
                        <th>Komisi SPV</th>
                        <th>Komisi Manager</th>
                        <th>Diajukan</th>
                        <th>Status</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($komisi as $km)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$km->no_komisi}}</td>
                        <td style="width: 100px">{{$km->tanggal_komisi}}</td>
                        <td>{{$km->no_spr}}</td>
                        <td>@currency($km->nominal_sales)</td>
                        <td style="width: 100px">@currency($km->nominal_spv)</td>
                        <td>@currency($km->nominal_manager)</td>
                        <td>{{$km->spv}}</td>
                        <td>{{$km->status_pembayaran}}</td>
                        <td style="width: 80px">
                            @if ($km->tanggal_pembayaran)
                                {{$km->tanggal_pembayaran}}
                            @else
                                {{Carbon\Carbon::now()->format('d-m-Y')}}
                            @endif
                        </td>
                        <td>
                            <div class="text-center">
                                <a href="{{route('resepsionis.updatekomisi', $km->id)}}">
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
@stop