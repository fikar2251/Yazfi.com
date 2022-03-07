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
                            <th>Tanggal</th>
                            <th>No SPR</th>
                            <th>Komisi Sales</th>
                            <th>Komisi SPV</th>
                            <th>Komisi Manager</th>
                            <th>Diajukan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($komisi as $km)
                        <td>{{$loop->iteration}}</td>
                        <td>{{$km->no_komisi}}</td>
                        <td>{{$km->tanggal_komisi}}</td>
                        <td>{{$km->no_spr}}</td>
                        <td>@currency($km->nominal_sales)</td>
                        <td>@currency($km->nominal_spv)</td>
                        <td>@currency($km->nominal_manager)</td>
                        <td>{{$km->spv}}</td>
                        <td>{{$km->status_pembayaran}}</td>
                        <td>
                            <div class="text-center">
                                <a href="#">
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa-solid fa-check"></i></button>
                                </a>
                            </div>
                        </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
