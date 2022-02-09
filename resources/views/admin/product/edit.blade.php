@extends('layouts.master', ['title' => 'Product'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Edit Produk</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="{{ route('admin.product.update', $product->id) }}" method="post">
            @method('PATCH')
            @csrf

            @include('admin.product.form')

        </form>
    </div>
</div>
@stop