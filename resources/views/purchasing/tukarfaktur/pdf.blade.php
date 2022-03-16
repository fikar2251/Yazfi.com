<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tukar Faktur</title>
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }


        .table {
            color: #000;
            border: 1px solid #f0f0f0;
        }

        .table.table-white {
            background-color: #fff;
        }

        .table>tbody>tr>td {
            font-weight: 300;
        }

        .table-striped>tbody>tr:nth-of-type(2n + 1) {
            background-color: #f6f6f6;
        }

        table.table td .avatar {
            margin: 0 5px 0 0;
        }

        table.table td h2 {
            display: inline-block;
            font-size: inherit;
            font-weight: 400;
            margin: 0;
            padding: 0;
            vertical-align: middle;
        }

        table.table td h2 a {
            color: #757575;
        }

        table.table td h2 a:hover {
            color: #009efb;
        }

        table.table td h2 span {
            color: #9e9e9e;
            display: block;
            font-size: 12px;
            margin-top: 3px;
        }

    </style>
    
    <script src="{{ 'https://kit.fontawesome.com/d64a16c1a6.js'}}" crossorigin="anonymous"></script>
    <!-- Sweetalert -->
    <link rel="stylesheet" href="{{ 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css'}}" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="{{'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'}}" rel="stylesheet" />
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{'https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css'}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet"  href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet"  href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet"  href="{{ asset('/css/select2.min.css') }}">
    <link rel="stylesheet"  href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-10 body-main">
                <div class="col-md-12">
                    <div class="card shadow" id="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="dashboard-logo">
                                        <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                            </div>
                        </div> --}}
                        <div class="col-md-8">

                        </div>
                    </div><br>
                    <br />
                    {{-- @foreach($detail as $tur)
                            @endforeach --}}
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <p style="font-size: 12px;">Nama Vendor :
                                            <a>
                                                {{-- <td>{{ $tur->nama }}</td> --}}
                                            </a>
                                        </p style="font-size: 12px;">
                                        <p style="font-size: 12px;">Nilai Invoice :
                                            <a style="font-size: 12px;">
                                                {{-- @currency($tur->nilai_invoice) --}}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px;">Keterangan Pembayaran :
                                            <a style="font-size: 12px;">
                                                {{-- <td>{{$tur->status_pembayaran}}</td> --}}
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
                                        <p style="font-size: 12px;">No Faktur :
                                            <a style="font-size: 12px;">
                                                {{-- <td>{{$tur->no_faktur}}</td> --}}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px;">Tanggal Tukar Faktur :
                                            {{-- <a style="font-size: 12px">{{ Carbon\Carbon::parse($tur->tanggal_tukar_faktur)->format('d/m/Y') }}
                                            </a> --}}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered  report">
                                    <tr style="font-size:12px;" class="bg-success">
                                        <th class=" text-light text-center">No.</th>
                                        <th class="text-light text-center">Kelengkapan Dokumen</th>
                                        <th class="text-light text-center">Ada</th>
                                        <th class="text-light text-center">Tidak Ada</th>
                                        <th class="text-center text-light" style="width: 210px;"> Catatan</th>
                                    </tr>
                                    <tbody>
                                        @foreach($detail as $dokumens)
                                        <tr style="font-size:12px;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dokumens->nama_dokumen }}</td>
                                            <td>{{ $dokumens->pilihan == 'Y'? "√" : "" }}</td>
                                            <td>{{ $dokumens->pilihan == 'T' ? "√" : ""}}</td>
                                            <td>{{ $dokumens->catatan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <p style="margin-top:20px;font-size:12px;" class="text-center">Pengirim,</p>
                                        <br>
                                        <br>
                                        <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">
                                            (.......................................)</p>
                                        <p style="margin-top: -10px;font-size:12px;" class="text-center m-b-2">Nama
                                            Jelas</p>
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
                                        <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">
                                            (.......................................)</p>
                                        <p style="margin-top: -10px; font-size:12px;" class="text-center m-b-2">Nama
                                            Jelas</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-sg-4 m-b-4">

                            <div class="form-group">
                                <p class="text-left" style="text-decoration:underline;font-size:10px;"><strong>Syarat
                                        Tukar Faktur</strong></p>
                                <ul style="list-style-type: square; margin-top:-15px;margin-left:-15px;font-size:10px;">
                                    <li>Peneromaan tukar faktur setiap hari Selasa dan Kamis jam 10.00 s/d jam 15.00 WIB
                                    </li>
                                    <li>Pembayaran direalisasikan setiap hari selasa</li>
                                    <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                    <li>Divisi keuangan berhak menolak dokumen tagihan jika terdapat kekurangan dokumen
                                        dan</li>
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

</body>

</html>
