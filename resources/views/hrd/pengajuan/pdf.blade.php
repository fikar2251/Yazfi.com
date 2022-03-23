<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="yoriadiatma">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Pengajuan Dana</title>
    <style>
        @page {
            margin: 0
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12;
        }

        .table-kop tr td {
            padding: 5px;
        }

        .italic {
            font-style: italic;
        }

        .sheet {
            overflow: hidden;
            position: relative;
            display: block;
            margin: 0 auto;
            box-sizing: border-box;
            page-break-after: always;
        }

        /** Paper sizes **/
        body.A3 .sheet {
            width: 297mm;
            height: 419mm
        }

        body.A3.landscape .sheet {
            width: 420mm;
            height: 296mm
        }

        body.A4 .sheet {
            width: 210mm;
            height: 296mm
        }

        body.struk .sheet {
            width: 100mm;
        }

        body.A4.landscape .sheet {
            width: 297mm;
            height: 209mm
        }

        body.A5 .sheet {
            width: 148mm;
            height: 209mm
        }

        body.A5.landscape .sheet {
            width: 210mm;
            height: 147mm
        }

        /** Padding area **/
        .sheet.padding-1mm {
            padding: 1mm
        }

        .sheet.padding-10mm {
            padding: 10mm
        }

        .sheet.padding-15mm {
            padding: 15mm
        }

        .sheet.padding-20mm {
            padding: 20mm
        }

        .sheet.padding-25mm {
            padding: 25mm
        }

        /** For screen preview **/
        @media screen {
            body {
                background: #e0e0e0
            }

            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
                margin: 5mm auto;
                display: block;
            }
        }

        /** Fix for Chrome issue #273306 **/
        @media print {
            body.A3.landscape {
                width: 420mm
            }

            body.A3,
            body.A4.landscape {
                width: 297mm
            }

            body.A4,
            body.A5.landscape {
                width: 210mm
            }

            body.A5 {
                width: 148mm
            }
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-3 body-main">
                <div class="col-md-12">
                    <div class="card shadow" id="card">
                        @foreach($pengajuan as $peng)
                        @endforeach
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dashboard-logo">
                                        <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                    </div>
                                </div>
                                <div class="col-md-8 text-right">
                                    <h6><span
                                            style="font-size: 15px; color:white; background-color:blue;">{{$peng->nomor_pengajuan}}</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h2><span style="color:blue; text-decoration: underline; font-size: 20px">Pengajuan
                                            Dana</span></h2>
                                </div>
                            </div> <br />
                            <div class="payment-details">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p style="margin-right:50%;" style="font-size: 12px">Nama :
                                            <a>
                                                {{ $peng->admin->name }}
                                            </a>
                                        </p style="font-size: 12px">
                                        <p style="font-size: 12px">Jabatan :
                                            <a style="font-size: 12px">
                                                {{ $jabatan->nama }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Divisi :
                                            <a style="font-size: 12px">
                                                {{ $peng->roles->name }}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 tex-right">
                                        <div class="form-group">
                                            <p style="font-size: 12px">Tanggal : <a
                                                    style="font-size: 12px">{{ Carbon\Carbon::parse($peng->tanggal_pengajuan)->format('d/m/Y H:i:s') }}
                                                </a></p>
                                        </div>
                                        <div class="form-group">
                                            <p style="font-size: 12px">Lampiran : <a
                                                    style="font-size: 12px">{{ $peng->file }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered  ">
                                            <tr class="bg-success">
                                                <th class="text-light">No.</th>
                                                <th class="text-light">Keterangan</th>
                                                <th style="width:15%;" class="text-light">Harga Satuan</th>
                                                <th class="text-light">Kwitansi</th>
                                                <th style="width:5%;" class="text-light">Qty</th>
                                                <th style="width:5%;" class="text-light">Unit</th>
                                                <th style="width:20%;" class="text-light">Deskripsi</th>
                                                <th style="width:20%;" class="text-light">Jumlah</th>
                                            </tr>
                                            <tbody>

                                                @php
                                                $total = 0
                                                @endphp
                                                @foreach(App\RincianPengajuan::where('nomor_pengajuan',
                                                $peng->nomor_pengajuan)->get() as $barang)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $barang->barang_id }}</td>
                                                    <td>@currency($barang->harga_beli)</td>
                                                    <td>{{$barang->no_kwitansi}}</td>
                                                    <td>{{$barang->qty}}</td>
                                                    <td>{{$barang->unit}}</td>
                                                    <td>{{ $barang->keterangan }}</td>
                                                    <td>@currency($barang->total)</td>
                                                </tr>

                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"><strong>Total<strong> </td>
                                                    <td colspan="2"><b>@currency($barang->grandtotal)</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8" rowspan="1">Cat :</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p class="text-center">Diajukan Oleh,</p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p class="text-center">DiPeriksa,</p>
                                                        <br>
                                                        <br>
                                                        <p class="text-left">Manager</p>
                                                        <p class="text-right" style="margin-top: -37px;">Keuangan</p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p class="text-center">DiSetujui,</p>
                                                        <br>
                                                        <br>
                                                        <p class="text-center">Direktur</p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p class="text-center">DiKetahui,</p>
                                                        <br>
                                                        <br>
                                                        <p class="text-center">Komisaris</p>
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                <td colspan="6" rowspan="2">Cat :</td>
                                            </tr> -->

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
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
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
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
