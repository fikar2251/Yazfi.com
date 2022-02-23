@extends('layouts.master', ['title' => 'Unit'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Add Unit</h4>
    </div>
</div>

<form action="{{ route('admin.unit.store') }}" method="post">
    @csrf
    @include('admin.unit.form')
</form>
@stop
