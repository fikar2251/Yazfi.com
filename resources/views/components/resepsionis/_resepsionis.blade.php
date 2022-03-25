@error('images')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <b>Error, </b> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@enderror

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa-solid fa-money-bill-wave"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $bayar }}</h3>

                <span class="widget-title2"> <a style="color: white" href="{{ url('finance/daftar') }}"> Pembayaran pending <i
                            class="fa fa-check" aria-hidden="true"></i>
                    </a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa-solid fa-arrow-right-arrow-left"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $refund }}</h3>
                <span class="widget-title3"> <a style="color: white" href="{{url('finance/refund/daftar')}}"> Refund pending<i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa-solid fa-money-check-dollar"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{ $komisi }} </h3>
                <span class="widget-title4"> <a style="color: white" href="{{url('finance/komisi/daftar')}}"> Komisi pending<i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>

{{-- <div class="row">
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Jadwal Hari Ini</h4> <a href="{{ route('resepsionis.appointments.index') }}" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($jadwal as $jdw)
                        <tr>
                            <td style="min-width: 100px;">
                                <a class="avatar" href="#"><img src="{{ asset('storage/' . $jdw->pasien->pict) }}" alt=""></a>
                                @php
                                $age = explode(",", $jdw->pasien->ttl)
                                @endphp
                                <h2><a href="">{{ $jdw->pasien->nama }}<span>{{ $jdw->pasien->jk }}, {{ \Carbon\Carbon::parse($jdw->pasien->tgl_lahir)->diff(\Carbon\Carbon::now())->format('%y') }}</span></a></h2>
                            </td>
                            <td>
                                <h5 class="time-title p-0">{{ $jdw->dokter->name }}</h5>
                                <p>{{ \Carbon\Carbon::parse($jdw->jam_status)->format('H.i') }} - {{ \Carbon\Carbon::parse($jdw->jam_selesai)->format('H.i') }}</p>
                            </td>
                            <td>
                                <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $jdw->id }}">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Datang</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card member-panel">
            <div class="card-header bg-white">
                <h4 class="card-title mb-0">Pasien Datang</h4>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                    @foreach ($datang as $dtng)
                    <li class="d-flex">
                        <div class="contact-cont mr-auto">
                            <div class="float-left user-img m-r-10">
                                <a href="#" class="avatar"><img src="{{ asset('/storage/' . $dtng->pasien->pict) }}" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                            </div>
                            <span class="contact-name">{{ $dtng->pasien->nama }}</span>
                            <div class="contact-info">
                                <!-- <span class="contact-date">MBBS, MD</span> -->
                            </div>
                        </div>
                        <div class="form">
                            <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtng->id }}">
                                <input type="hidden" name="status" value="3">
                                <button type="submit" class="btn btn-sm btn-outline-success">Periksa</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div> -->
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card member-panel">
            <div class="card-header bg-white">
                <h4 class="card-title mb-0">Pasien Diperiksa</h4>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                    @foreach ($periksa as $prk)
                    <li class="d-flex">
                        <div class="contact-cont mr-auto">
                            <div class="float-left user-img m-r-10">
                                <a href="#" class="avatar"><img src="{{asset('/storage/' . $prk->pasien->pict)}}" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                            </div>
                            <span class="contact-name">{{ $prk->pasien->nama }}</span>
                        </div>
                        <div class="form">
                            <!-- <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                @csrf
                                <input type="hidden" name="id" value="{{ $prk->id }}">
                                <input type="hidden" name="status" value="4">
                            </form> -->
                            <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#modalUpload{{ $prk->id }}">Selesai</button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div> -->
        </div>
    </div>
</div>

@foreach ($periksa as $prk)
<div class="modal fade" id="modalUpload{{ $prk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Foto Pemeriksaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('resepsionis.appointments.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $prk->id }}">
                    <input type="hidden" name="status" value="4">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" name="images[]" id="image" class="form-control-file" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}
