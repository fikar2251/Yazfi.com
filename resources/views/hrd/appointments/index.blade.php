@extends('layouts.master', ['title' => 'Appointment'])

@section('content')

<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Appointments Global List Doctor</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="{{ route('hrd.appointments.resign') }}" class="btn btn-info">(Dokter Resign) Tindakan yang belum selesai : {{ $count  }}</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table">
                        <thead>
                            <tr>
                                <th rowspan="2">Id</th>
                                <th rowspan="2">No Booking</th>
                                <th rowspan="2">Nama Pasien</th>
                                <th colspan="3">Dokter</th>
                                <th rowspan="2">Nama Tindakan</th>
                                <th rowspan="2">Status Booking</th>
                                <th rowspan="2">Status Tindakan</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Dokter Booking</th>
                                <th>Dokter Pengganti</th>
                                <th>Tanggal Penggantian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tindakan as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td><span class="badge badge-success">{{ $book->booking->no_booking }}</span></td>
                                <td>{{ $book->booking->pasien->nama }}</td>
                                <td>{{ $book->booking->dokter->name }}</td>
                                <th>{{ $book->booking->dokter_pengganti->name ?? 'Kosong' }}</th>
                                <th>{{ $book->booking->tanggal_pengganti ?? 'Kosong'  }}</th>
                                <td>{{ $book->item->nama_barang }}</td>
                                <td><span class="custom-badge status-{{ $book->booking->status->warna }}">{{ $book->booking->status->status }}</span></td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>
                                            @if($book->status)
                                            <span class="custom-badge status-green">{{ $book->item->nama_barang }} - {{ $book->dokter->name }}</span>
                                            @else
                                            <span class="custom-badge status-red">{{ $book->item->nama_barang }} - {{ $book->dokter->name }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('hrd.appointments.show', $book->booking->id) }}" class="btn btn-success">Image</a>
                                        <a href="{{ route('hrd.appointments.edit', $book->booking->id) }}" class="btn btn-warning">Edit</a>
                                    </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>
    $(document).ready(function() {
        table = $('#table').DataTable()
    });
</script>
@stop