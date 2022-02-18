@extends('layouts.master', ['title' => 'List SPR'])
@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Daftar SPR </h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="add-doctor.html" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Unit</a>
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
                                <th>Type</th>
                                <th>Blok</th>
                                <th>No.</th>
                                <th>LB</th>
                                <th>LT</th>
                                <th>NSTD</th>
                                <th>Total</th>
                                <th>Harga Jual</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $item)
                            <tr>
                                <td>{{$item->id_unit_rumah}}</td>
                                <td>{{$item->type}}</td>
                                <td>
                                   
                                    {{$item->blok}}
                                </td>
                                <td>
                                    
                                    {{$item->no}}
                                </td>
                                <td>
                                  
                                    {{$item->lb}}
                                </td>
                                <td>{{$item->lt}}</td>
                                <td>{{$item->nstd}}</td>
                                <td>
                                   
                                    {{{$item->total}}}
                                </td>
                                <td>
                                   
                                    {{$item->harga_jual}}
                                </td>
                                <td>
                                
                                    @if ($item->status_penjualan = 'Available')
                                    {{$item->status_penjualan}}
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