<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="{{ asset('img/favicon.png') }}" rel="shortcut icon"> --}}
    {{-- <title>{{ \App\Setting::find(1)->web_name }} - {{ $title }}</title> --}}
    <link rel="stylesheet" type="text/css" href="{{ public_path('/') }}css/bootstrap.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ public_path('/') }}css/font-awesome.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="public/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ public_path('/') }}css/style.css">
    {{-- <link rel="stylesheet" type="text/css" href="public/css/style.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap-datetimepicker.min.css">
    <script src="https://kit.fontawesome.com/d64a16c1a6.js" crossorigin="anonymous"></script> --}}

    {{-- <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css"
        integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}


    <style>
        /* .page-wrapper {
            left: 0;
            margin-left: 30px;
            padding-top: 20px;
            position: relative;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .page-wrapper>.content {
            padding: 15px;
        } */

        .text-center {
            text-align: center !important
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important
        }

    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="text-center">
                    <h4 style="font-size: 30px; font-weight: 500; text-decoration: underline" class="page-title mb-3">
                        SURAT PEMESANAN
                        RUMAH</h4>
                </div>

                <div class=" row d-flex justify-content-center" style="margin-left: 250px">
                        <table class="table table-borderless" style="border: none">
                            <tbody>
                                <tr>
                                    <td style="width: 100px">No</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->no_transaksi }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 100px">Tanggal</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->tanggal_transaksi }} </td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-title">I. Data Pembeli</h4>                            
                                    <table class="table table-bordered" style="margin-left: 30px; ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Konsumen</td>
                                                <td style="width: 20px">:</td>
                                                <td> {{ $spr->nama }} </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">No KTP</td>
                                                <td style="width: 20px">:</td>
                                                <td> {{ $spr->no_ktp }} </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">No NPWP</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->npwp }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">No Tlp</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->no_tlp }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">No HP</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->no_hp }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Email</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Alamat</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->alamat }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Pekerjaan</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->pekerjaan }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                               
                                <h4 class="card-title mt-5">II. Data Unit Rumah</h4>                           
                                    <table class="table table-bordered" style="margin-left: 30px">
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Type</td>
                                                <td style="width: 20px">:</td>
                                                <td colspan="4"> {{ $spr->unit->type }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Blok</td>
                                                <td style="width: 20px">:</td>
                                                <td> {{ $spr->unit->blok }}

                                                    {{-- <tr> --}}
                                                <td style="width: 100px">No</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->unit->no }}
                                                </td>
                                                {{-- </tr> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Luas tanah</td>
                                                <td style="width: 20px">:</td>
                                                <td colspan="4">
                                                    {{ $spr->unit->lt }} M<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Luas Bangunan</td>
                                                <td style="width: 20px">:</td>
                                                <td colspan="4">
                                                    {{ $spr->unit->lb }} M<sup>2</sup>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Penambahan Luas Tanah</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    @if ($spr->unit->nstd = '-')
                                                        -
                                                    @else
                                                        {{ $spr->unit->nstd }} M<sup>2</sup>
                                                    @endif

                                                <td style="width: 100%">Total</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->unit->total }} M<sup>2</sup>
                                                </td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Harga Jual</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    @currency($spr->harga_jual)

                                                <td style="width: 100px">Harga Net</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    @currency($spr->harga_net)
                                                </td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('/') }}js/popper.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}js/jquery.slimscroll.js"></script>
    <script src="{{ asset('/') }}js/app.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>
    <script src="{{ asset('/') }}js/moment.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"
        integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Datatables -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


    <script>
        $('.delete-form').on('click', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Delete this data ?',
                text: "Are you sure you want to delete this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    return form.submit();
                }
            })
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
</body>

</html>
