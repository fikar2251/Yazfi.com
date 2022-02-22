@extends('layouts.master', ['title' => 'Edit User'])

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h4 class="page-title">Edit User</h4>
    </div>
</div>

<form action="{{ route('hrd.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    @include('hrd.users.form')
</form>
@stop