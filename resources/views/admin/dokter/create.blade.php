@extends('layouts.master', ['title' => 'Add dokter'])

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h4 class="page-title">Add dokter</h4>
    </div>
</div>

<form action="{{ route('admin.dokter.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.dokter.form')

</form>
@stop

@section('footer')
<script>
    $(".select2").select2()
</script>
@stop