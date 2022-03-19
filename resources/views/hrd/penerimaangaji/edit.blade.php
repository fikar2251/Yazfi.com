@extends('layouts.master', ['title' => 'Edit Penerimaan Gaji'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <a href="{{ route('hrd.penerimaangaji.index') }} " class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('hrd.penerimaangaji.update', $penerimaan->id) }}" method="post" id="form">
                    @csrf
                    @method('put')
                    @include('hrd.penerimaangaji.form')

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
