@extends('layouts.master', ['title' => 'Edit Jabatan'])

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h4 class="page-title">Edit Jabatan</h4>
    </div>
</div>

<form action="{{ route('hrd.jabatan.store') }}" method="post">
    @csrf
    @include('hrd.jabatan.form')

</form>
@stop