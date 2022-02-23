@extends('layouts.master', ['title' => 'Kategori Barang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Add Kategori Barang</h4>
    </div>
</div>

<form action="{{ route('admin.kategori-barang.update', $barangs->id) }}" method="post">
    @method('PATCH')
    @csrf

    @include('admin.kategori-barang.form')
</form>
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $('#jenis').click(function() {
            $(this).is(':checked') ? $(this).val(barang) : $(this).val(service);
        });
    });
</script>
@stop