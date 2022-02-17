@extends('layouts.master', ['title' => 'Pricelist'])
@section('content')
@php

use App\Marketing;



$stock = DB::table('unit_rumah')->select('type')->distinct()->get();

$AWAL = 'SP';
$noUrutAkhir = '0';
$nourut = $AWAL . '/' . sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));


@endphp

<form action="{{route('marketing.pricelist.store')}}" method="POST">
    @csrf

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">SURAT PEMESANAN RUMAH</h4>
            <div class="text-center">
               
                    
                    <h1>{{$id}}</h1>
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text" name="no_transaksi" id="tanggal" value="{{$nourut}}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text" name="tanggal_transaksi" id="tanggal_transaksi" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-4">
            <h4 class="page-title">I. Data Pembeli</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">No KTP</label>
                <input type="number" name="no_ktp" id="no_ktp" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">NPWP</label>
                <input type="number" name="npwp" id="npwp" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>

                @error('address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_number">No. Telp</label>
                <input type="number" name="no_tlp" id="no_tlp" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">No. HP</label>
                <input type="number" name="no_hp" id="no_hp" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">

                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">

                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-4">
            <h4 class="page-title">II. Data Unit Rumah</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Type</label>
                <select name="type" id="type" class="form-control dynamic" data-dependent="blok">
                    <option value="">-- Select Type --</option>
                    @foreach ($blok as $item)
                    <option value="{{$item->type}}">{{$item->type}}</option>
                    @endforeach
                </select>

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Blok</label>
                <select name="blok" id="blok" class="form-control dinamis root2" data-dependent="no">
                    <option value=""></option>
                </select>

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">No.</label>
                <select name="no" id="no" class="form-control lt root1" data-dependent="lt">
                    <option value=""></option>
                </select>

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Luas tanah</label>
                <select name="lt" id="lt" class="form-control hj root4">
                    <option value=""></option>
                </select>
                {{-- <input type="number" name="lt" id="lt" class="form-control root4" value=""> --}}
                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Harga Jual</label>
                <select name="harga_jual" id="harga_jual" class="form-control disabled root5">
                    <option value=""></option>
                </select>
                {{-- <input type="number" name="phone_number" id="phone_number" class="form-control"> --}}
                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Potongan</label>
                <input type="number" name="potongan" id="potongan" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Harga Net</label>
                <input type="number" name="harga_net" id="harga_net" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_number">Luas bangunan</label>
                {{-- <input type="number" name="phone_number" id="phone_number" class="form-control disabled root6"> --}}
                <select name="lb" id="lb" class="form-control disabled root6">
                    <option value=""></option>
                </select>

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Penambahan Luas Tanah</label>
                <input type="number" name="plt" id="plt" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Total Luas Tanah</label>
                <input type="number" name="tlt" id="tlt" class="form-control">

                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-5">
                <hr>
            </div>
            <div class="form-group">
                <label for="name">Booking Fee</label>
                <input type="number" name="booking_fee" id="booking_fee" class="form-control">

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Downpayment</label>
                <input type="number" name="downpayment" id="downpayment" class="form-control">

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Skema Pembayaran</label>
                <select name="skema" id="skema" class="form-control">
                    <option value="">-- Skema Pembayaran --</option>
                    <option value="cash_bertahap">Cash Bertahap</option>
                    <option value="syariah">Syariah</option>
                    <option value="kpr">KPR</option>
                </select>
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="m-t-20 text-center">
        <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
    </div>
</form>

</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" --}}
<script>
    $(document).ready(function() {
        $('.dynamic').change(function() {

            var type = $(this).val();
            var blok = $(this).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                url: `/marketing/blok`,
                method: "get",
                data: {
                    'type': type,
                    'blok': blok,
                    'no': no,
                    'lt': lt,
                },
                success: function(data) {
                    console.log(data);
                    op += '<option value="0">--Select Blok--</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].blok + '">' + data[i].blok + '</option>'
                    };
                    $('.root2').html(op);
                },
                error: function() {

                }
            })
        })
    })
    $(document).ready(function() {
        $('.dinamis').change(function() {

            var type = $(this).val();
            var blok = $(this).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                url: `/marketing/no`,
                method: "get",
                data: {
                    'type': type,
                    'blok': blok,
                    'no': no,
                    'lt': lt,
                },
                success: function(data) {
                    console.log(data);
                    op += '<option value="0">--Select No--</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value=" ' + data[i].no + ' ">' + data[i].no + '</option>'
                    };
                    $('.root1').html(op);
                },
                error: function() {

                }
            })
        })
    })
    $(document).ready(function() {
        $('.lt').change(function() {

            var blok = $('.root2').html(op).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            var lt = " ";
            var hj = " ";
            var lb = " ";
            console.log(blok)
            $.ajax({
                url: `/marketing/lt`,
                method: "get",
                data: {
                    // 'type': type,
                    'blok': blok,
                    'no': no,
                    'lt': lt,

                },
                success: function(data) {
                    console.log(data);
                    // op += '<option value="0">--Select Lt--</option>';
                    // op +=  '<input type="number" name="lt" id="lt" class="form-control" value="0">';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].lt + '">' + data[i].lt + '</option>'
                        // op +=  '<input type="number" name="lt" id="lt" class="form-control" value="'+ data[i].lt +'">';
                        lt += '<option value="' + data[i].lt + '">' + data[i].lt + '</option>'
                        hj += '<option value="' + data[i].harga_jual + '">' + data[i].harga_jual + '</option>'
                        lb += '<option value="' + data[i].lb + '">' + data[i].lb + '</option>'
                    };
                    $('.root4').html(op);
                    $('.root5').html(hj);
                    $('.root6').html(lb);
                },
                error: function() {

                },

            })
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#potongan").keyup(function() {
            var harga_jual = parseInt($("#harga_jual").val());
            var potongan = parseInt($("#potongan").val());
            var total = (harga_jual * 1000000) - potongan;
            $("#harga_net").val(total);
        });
    });
    $(document).ready(function() {
        $("#plt").keyup(function() {
            var lb = parseInt($("#lb").val());
            var plt = parseInt($("#plt").val());
            var total = lb + plt;
            $("#tlt").val(total);
        });
    });
</script>
@stop