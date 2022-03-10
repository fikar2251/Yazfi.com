<!doctype html>
<html lang="en">
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset("img/favicon.png")}}" rel="shortcut icon">
    {{-- <title>{{ \App\Setting::find(1)->web_name }} - {{ $title }}</title> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

	<link rel="stylesheet"href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css')}}" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet')}}" />
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Tukar Faktur</h4>
    </div>
   
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-10 body-main">
            <div class="col-md-12">
                <div class="card shadow" id="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-logo">
                                    <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                </div>
                            </div>
                            <div class="col-md-8">
                               
                            </div>
                        </div><br>
                        <br />
                        {{-- <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="font-size: 12px">Nama Vendor :
                                                <a>
                                                    <td>{{ $detail->nama }}</td>
                                                </a>
                                            </p style="font-size: 12px">
                                            <p style="font-size: 12px">Nilai Invoice :
                                                <a style="font-size: 12px">
                                                    @currency($detail->nilai_invoice)
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Keterangan Pembayaran :
                                                <a style="font-size: 12px">
                                                    <td>{{$detail->status_pembayaran}}</td>
                                                </a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="font-size: 12px">No Faktur :
                                                <a style="font-size: 12px">
                                                    <td>{{$detail->no_faktur}}</td>
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Tanggal Tukar Faktur : <a style="font-size: 12px">{{ Carbon\Carbon::parse($detail->tanggal_tukar_faktur)->format('d/m/Y H:i:s') }}
                                                </a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th class=" text-light">No.</th>
                                            <th class="text-light">Kelengkapan Dokumen</th>
                                            <th class="text-light">Ada</th>
                                            <th class="text-light">Tidak Ada</th>
                                            <th class="text-light"> Catatan</th>
                                        </tr>
                                        <tbody>
                                            @foreach(App\DetailTukarFaktur::where('no_faktur', $detail->no_faktur)->get() as $dokumens)
                                            <tr style="font-size:12px;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dokumens->data->nama_dokumen }}</td>
                                                <td>{{ $dokumens->pilihan == 'Y'}}</td>
                                                <td>{{ $dokumens->pilihan == 'T'}}</td>
                                                <td>{{ $dokumens->catatan }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="margin-top:20px;font-size:12px;" class="text-center">Pengirim,</p>
                                            <br>
                                            <br>
                                            <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">(.......................................)</p>
                                            <p style="margin-top: -10px;font-size:12px;" class="text-center m-b-2">Nama Jelas</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="margin-top:20px;font-size:12px;" class="text-center">Penerima,</p>
                                            <br>
                                            <br>
                                            <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">(.......................................)</p>
                                            <p style="margin-top: -10px; font-size:12px;" class="text-center m-b-2">Nama Jelas</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-sg-4 m-b-4">

                                <div class="form-group">
                                    <p class="text-left" style="text-decoration:underline;font-size:10px;"><strong>Syarat Tukar Faktur</strong></p>
                                    <ul style="list-style-type: square; margin-top:-15px;margin-left:-15px;font-size:10px;">
                                        <li>Peneromaan tukar faktur setiap hari Selasa dan Kamis jam 10.00 s/d jam 15.00 WIB</li>
                                        <li>Pembayaran direalisasikan setiap hari selasa</li>
                                        <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                        <li>Divisi keuangan berhak menolak dokumen tagihan jika terdapat kekurangan dokumen dan</li>
                                        <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                        <li>adanya kesalahan ketik atau perhitungan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('/') }}js/popper.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}js/jquery.slimscroll.js"></script>
    <script src="{{ asset('/') }}js/app.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>
    <script src="{{ asset('/') }}js/moment.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Sweetalert -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js')}}" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Select2 -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js')}}"></script>
</body>
</html>
