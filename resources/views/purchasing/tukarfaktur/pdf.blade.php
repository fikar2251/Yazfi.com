<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Penggajian Karyawan</title>
    <style>
        @media print {
            @page {
                size: A4;
                /* DIN A4 standard, Europe */
                margin: 0;
            }

            html,
            body {
                width: 197mm;
                height: 297mm;
                /* height: 282mm; */
                font-size: 13px;
                background: #FFF;
                overflow: visible;
            }

            body {
                padding-top: 15mm;
            }
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-10 body-main">
                <div class="col-md-12">
                    <div class="card shadow" id="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="dashboard-logo">
                                    <img style="width:150px;" src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                </div>
                                <div class="col-md-8">

                                </div>
                            </div><br>
                            <br />
                            @foreach($detail as $tur)
                            @endforeach
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-sg-4 m-b-">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="form-group">
                                                    <p style="font-size: 12px">Nama Vendor :
                                                        <a>
                                                            <td>{{ $tur->nama }}</td>
                                                        </a>
                                                    </p style="font-size: 12px">
                                                    <p style="font-size: 12px">Nilai Invoice :
                                                        <a style="font-size: 12px">
                                                            @currency($tur->nilai_invoice)
                                                        </a>
                                                    </p>
                                                    <p style="font-size: 12px">Keterangan Pembayaran :
                                                        <a style="font-size: 12px">
                                                            <td>{{$tur->status_pembayaran}}</td>
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
                                                            <td>{{$tur->no_faktur}}</td>
                                                        </a>
                                                    </p>
                                                    <p style="font-size: 12px">Tanggal Tukar Faktur : <a
                                                            style="font-size: 12px">{{ Carbon\Carbon::parse($tur->tanggal_tukar_faktur)->format('d/m/Y') }}
                                                        </a></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-sg-4 m-b-4">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="form-group">
                                                    <p style="margin-top:20px;font-size:12px;" class="text-center">
                                                        Pengirim,
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <p style="margin-top: 40px;font-size:12px;"
                                                        class="text-center m-b-2">
                                                        (.......................................)</p>
                                                    <p style="margin-top: -10px;font-size:12px;"
                                                        class="text-center m-b-2">
                                                        Nama
                                                        Jelas</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-sg-4 m-b-4">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="form-group">
                                                    <p style="margin-top:20px;font-size:12px;" class="text-center">
                                                        Penerima,
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <p style="margin-top: 40px;font-size:12px;"
                                                        class="text-center m-b-2">
                                                        (.......................................)</p>
                                                    <p style="margin-top: -10px; font-size:12px;"
                                                        class="text-center m-b-2">
                                                        Nama
                                                        Jelas</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-sg-4 m-b-4">

                                    <div class="form-group">
                                        <p class="text-left" style="text-decoration:underline;font-size:10px;">
                                            <strong>Syarat Tukar Faktur</strong></p>
                                        <ul
                                            style="list-style-type: square; margin-top:-15px;margin-left:-15px;font-size:10px;">
                                            <li>Peneromaan tukar faktur setiap hari Selasa dan Kamis jam 10.00 s/d jam
                                                15.00
                                                WIB</li>
                                            <li>Pembayaran direalisasikan setiap hari selasa</li>
                                            <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                            <li>Divisi keuangan berhak menolak dokumen tagihan jika terdapat kekurangan
                                                dokumen dan</li>
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
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>
            <script>
                window.print()

            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
