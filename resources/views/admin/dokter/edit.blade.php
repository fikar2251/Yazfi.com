@extends('layouts.master', ['title' => 'Edit Dokter'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Edit Dokter</h1>

        <x-alert></x-alert>

        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Edit Dokter</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('admin.dokter.form')

                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(".select2").select2()
</script>
@stop