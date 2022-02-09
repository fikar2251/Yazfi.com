@extends('layouts.master', ['title' => 'Ruangan'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Update Ruangan</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="{{ route('admin.ruangan.update', $ruangan->id) }}" method="post">
            @method('PATCH')
            @csrf
            @include('admin.ruangan.form')
        </form>
    </div>
</div>
@stop