<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">

</head>
<style>
    .page-wrapper {
	left: 0;
	margin-left: 100px;
	padding-top: 50px;
	position: relative;
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s ease;
}
</style>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="text-center">
                    <h4 style="font-size: 30px; font-weight: 500; text-decoration: underline" class="page-title mb-3">
                        SURAT
                        PEMESANAN
                        RUMAH</h4>
                </div>
                <div class=" row d-flex justify-content-center" style="margin-left: 100px">
                    <div class="col-sm-5">
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
                </div>

                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-title">I. Data Pembeli</h4>
                                <div class="table-responsive container">
                                    <table class="table table-borderless" style="border: none">
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
                                                    {{ $add->alamat }}, <br>
                                                    {{ $add->desa->subdis_name }},
                                                    {{ $add->kecamatan->dis_name }},
                                                    {{ $add->kota->city_name }}, {{ $add->provinsi->prov_name }}
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
                                </div>
                                <h4 class="card-title mt-5">II. Data Unit Rumah</h4>
                                <div class="table-responsive container">
                                    <table class="table table-borderless" style="border: none">
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
                                                <td style="width: 200px">No</td>
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

                                                <td style="width: 200px">Total</td>
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

                                                <td style="width: 200px">Harga Net</td>
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
    </div>
</body>

</html>
