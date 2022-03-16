@extends('layouts.master', ['title' => 'Edit Team Sales'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-md-6">
        <h4 class="page-title">Edit Team Sales</h4>
    </div>
</div>

<form action="{{ route('hrd.sales.update', $sale->id) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    @include('hrd.sales.form')
</form>
@stop

@section('footer')
<script>
    $(".select2").select2()
</script>
@stop