@extends('layouts.master', ['title' => 'Produk'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Barang</h4>
    </div>
    <!-- <div class="col-sm-8 col-9 text-right m-b-20">
        @can('cabang-create')
        <a href="{{ route('logistik.product.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Produk</a>
        @endcan
    </div> -->
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('logistik.product.show', $product->id) }}">{{ $product->kode_barang }}</a></td>
                        <td>{{ $product->nama_barang }}</td>
                        <td>{{ $product->nama_barang }}</td>
                        <td>{{ $product->nama_barang }}</td>
                        <td>
                            @foreach($product->produkharga as $stok)
                            {{ $stok->cabang->nama }} ({{ $stok->qty }}) <br>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop