@extends('layouts.master', ['title' => 'Master Dokter'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <x-alert></x-alert>

        <div class="row">
            <div class="col-sm-4 col-3">
                <h1 class="page-title">Master Dokter</h1>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
            </div>
        </div>
        <div class="row doctor-grid">
            @foreach($dokter as $dok)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="{{ route('admin.dokter.show', $dok->id) }}"><img alt="" src="{{ asset('storage/' . $dok->image) }}"></a>
                    </div>
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.dokter.edit', $dok->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                            <a class="dropdown-item" href="{{ route('admin.dokter.resign', $dok->id) }}" onclick="return confirm('Ubah Status Resign?')"><i class="fa fa-window-close m-r-5"></i> Resign</a>
                        </div>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a href="{{ route('admin.dokter.show', $dok->id) }}">{{ $dok->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $dok->address }}
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        @if($dok->is_active == 2)
                        <span class="custom-badge status-orange">Resign</span>
                        @endif
                        @if($dok->is_active == 1)
                        <span class="custom-badge status-green">Active</span>
                        @endif
                        @if($dok->is_active == 0)
                        <span class="custom-badge status-red">No Active</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop