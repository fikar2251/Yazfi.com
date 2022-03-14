@extends('layouts.master', ['title' => 'Satuan Barang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Add Satuan Barang</h4>
    </div>
</div>

<form action="{{ route('admin.satuan.store') }}" method="post">
    @csrf
    @include('admin.satuan.form')
</form>
@stop
