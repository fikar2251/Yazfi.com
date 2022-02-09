@extends('layouts.master', ['title' => 'Appointment'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table->bordered">
                        <thead>
                            <tr>
                                <th>No Booking <i class="fa fa-barcode"></i></th>
                                <th>Directoy <i class="fa fa-folder"></i></th>
                                <th>Image <i class="fa fa-file-image-o"></i></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $book)
                            <tr>
                                <td><span class="badge badge-success">{{ $book->booking->no_booking }}</span></td>
                                <th>{{ asset('/storage/'.$book->image) }}</th>
                                <td><img src="{{ asset('/storage/'.$book->image) }}" class="img-thumbnail" width="100" alt=""></td>
                                <td>
                                    <a href="{{ route('hrd.appointments.download', $book->id) }}" class="btn btn-primary">Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop