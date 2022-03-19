@extends('layouts.master', ['title' => 'Create Rincian Gaji'])
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <a href="{{ route('hrd.rincianpenggajian.index') }} " class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('hrd.rincianpenggajian.store') }}" method="post" id="form">
                    @csrf
                    @include('hrd.rincianpenggajian.form')
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-1 offset-sm-0">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@stop
