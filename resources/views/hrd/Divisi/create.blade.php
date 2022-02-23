@extends('layouts.master', ['title' => 'Cabang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Add Cabang</h4>
    </div>
</div>

<form action="{{ route('admin.cabang.store') }}" method="post">
    @csrf
    @include('admin.cabang.form')
</form>
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $('#pajak').click(function() {
            $(this).is(':checked') ? $(this).val(1) : $(this).val(0);
        });
    });
</script>
@stop