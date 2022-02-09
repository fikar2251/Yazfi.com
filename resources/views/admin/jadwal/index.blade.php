@extends('layouts.master', ['title' => 'Attendance'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Attendance Sheet</h4>
    </div>
</div>

<form action="{{ route('admin.attendance.search') }}" method="GET">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">Employee Name</label>
                @csrf
                <input type="text" value="{{ old('pegawai') }}" class="form-control floating" name="pegawai">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Select Month</label>
                <select class="select floating" name="month" value="{{ old('month') }}">
                    <option value="">-</option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">Mar</option>
                    <option value="04">Apr</option>
                    <option value="05">May</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Aug</option>
                    <option value="09">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Select Year</label>
                <select class="select floating" name="year" value="{{ old('year') }}">
                    <option value="">-</option>
                    <option>2023</option>
                    <option>2022</option>
                    <option>2021</option>
                    <option>2020</option>
                    <option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                    <option>2016</option> 
                    <option>2015</option>
                    <option>2014</option>
                    <option>2013</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-success btn-block"> Search </button>
        </div>
    </div>
</form>
@if($message = Session::get('error'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    </div>
</div>
@endif

@if($message = Session::get('success'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            {{ $message }}
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-round">
                    <div>
                        <a href="" class="btn btn-info text-light btn-block" id="tombol-hapus" value="delete">Update User Bulan</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border table-bordered table-hover">
                        <thead>

                            <tr class="text-center bg-success">
                                <th colspan="{{ 2 + $last_day_of_month }}">
                                    <h5 class="text-light">Attendance</h5>
                                </th>
                            </tr>
                            <tr class="text-center bg-info">
                                <th class="text-light">Nama</th>
                                <th class="text-light">Role</th>
                                @for($day = 1; $day <= $last_day_of_month; $day++) <th class="text-light">{{ $day }}</th>
                                    @endfor

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($user as $row)
                            <tr class="text-center">
                                <td><a class="btn btn-success" href="">{{ $row->name }}</a></td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($row->roles as $data)
                                            <li>{{ $data->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                @for($day = 1; $day <= $last_day_of_month; $day++) <td>
                                    @foreach($jadwal->where('user_id',$row->id)->where('tanggal', Carbon\Carbon::parse($date['year'].'-'.$date['month'].'-'.$day)->format('Y-m-d')) as $data)
                                    <div class="mb-4">
                                        @if($data->shift->kode == 'SF1'|| $data->shift->kode == 'SF2')
                                        <i class="fa fa-check text-success">{{ $data->shift->kode }}</i>
                                        @else
                                        <i class="fa fa-close text-danger">{{ $data->shift->kode }}</i>
                                        @endif
                                        <!-- <div class="btn-group">
                                            <button class="btn btn-danger" data-id="{{ $data->id }}" onclick="TheFunctionOfAjaxModal(this)" data-toggle="modal" data-target="#exampleModalCenter">{{ $data->user->name }}</button>
                                            <button class="btn btn-warning">{{ $data->id }}</button>
                                            <button class="btn btn-info">{{ $data->tanggal }}</button>
                                        </div> -->
                                    </div>
                                    @endforeach
                                    </td>
                                    @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.jadwal.modal')
@stop
@section('footer')
<script>
    const TheFunctionOfAjaxModal = function(element) {
        let attr = $(element).attr('data-id')
        $.ajax({
            url: `/api/attendance/${attr}`,
            success: data => {
                console.log(data)
            },
            error: error => {
                console.log(error)
                swal({
                    title: "There is something wrong",
                    text: `${error.statusText} : ${error.status} `,
                    icon: "warning",
                });
            }
        })
        console.log(attr)
    }
</script>
@stop