@extends('layouts.master', ['title' => 'Edit Appointment'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Booking</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Dokter Pengganti</th>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><input type="text" class="form-control" readonly value="{{ $booking->id }}" id="booking_id"></th>
                                <th>{{ $booking->no_booking }}</th>
                                <th>{{ $booking->pasien->nama }}</th>
                                <th>{{ $booking->dokter->name }}</th>
                                <th>
                                    <select class="form-control" id="dokter_pengganti_id">
                                        <option value="null">--Kosong--</option>
                                        @foreach($dokter as $data)
                                        <option @if($booking->dokter_pengganti_id == $data->id) selected @endif value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>{{ $booking->cabang->nama }}</th>
                                <th>{{ $booking->tanggal_status }}</th>
                                <th>{{ $booking->jam_status }} - {{ $booking->jam_selesai }}</th>
                                <th><span class="custom-badge status-{{ $booking->status->warna }}">{{ $booking->status->status }}</span></th>
                                <th><button class="btn btn-success" onclick="OnClickButton()">Update</button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function OnClickButton() {
        let dokter_pengganti_id = $('#dokter_pengganti_id').val()
        let booking_id = $('#booking_id').val()
        $.ajax({
            url: `/api/hrd/appointments/update/${booking_id}/${dokter_pengganti_id}`,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved'
                })
            },
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! : ' + error.statusText,
                    footer: '<a href="">Why do I have this issue?</a>'
                })
            }
        })
    }
</script>
@stop