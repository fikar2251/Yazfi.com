@extends('layouts.master', ['title' => 'Add Team Sales'])

@section('content')
<div class="row justify-content-left text-left">
    <div class="col-md-6">
        <h4 class="page-title">Add Team Sales</h4>
    </div>
</div>

<form action="{{ route('hrd.tim-sales.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('hrd.tim-sales.form')

</form>
@stop

@section('footer')
<script>
    $(".select2").select2()
</script>
@stop