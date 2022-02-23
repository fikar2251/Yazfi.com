@extends('layouts.master', ['title' => 'Add Jabatan'])

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h4 class="page-title">Add Jabatan</h4>
    </div>
</div>

<form action="{{ route('hrd.jabatan.store') }}" method="post">
    @csrf
    @include('hrd.jabatan.form')

</form>
@stop