@extends('layouts.master', ['title' => 'Kategori Barang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Add Kategori Barang</h4>
    </div>
</div>

<form action="{{ route('admin.kategoribarang.store') }}" method="post">
    @csrf
    @include('admin.kategoribarang.form')
</form>
@stop