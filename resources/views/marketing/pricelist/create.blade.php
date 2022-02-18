@extends('layouts.master', ['title' => 'Order SPR'])
@section('content')
@php

use App\Marketing;
use App\Spr;



$stock = DB::table('unit_rumah')->select('type')->distinct()->get();

$AWAL = 'SP';
$noUrutAkhir = Spr::max('id_transaksi');

$nourut = $AWAL . '/' . sprintf("%02s", abs($id)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));


@endphp

<form action="{{route('marketing.storespr', $id)}}" method="POST">
    @csrf

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">SURAT PEMESANAN RUMAH</h4>
            <div class="text-center">
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
                <input type="number" name="id_unit" id="id_unit" class="form-control" readonly hidden>

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
                <label for="phone_number">Luas bangunan</label>
                <input type="number" name="lb" id="luas_bangunan" class="form-control root6" readonly>
                @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Luas tanah</label>

                <input type="number" name="lt" id="lt" class="form-control root4" readonly>
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
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_number">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" class="form-control" readonly>
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
    
            console.log(blok)
            $.ajax({
                url: `/marketing/lt`,
                method: "get",
                data: {
                
                    'blok': blok,
                    'no': no,
                    'lt': lt,

                },
                success: function(data) {
                    console.log(data);
                  
                    for (var i = 0; i < data.length; i++) {
                 
                        var id_unit = data[i].id_unit_rumah;
                        document.getElementById('id_unit').value = id_unit;

                        var luas_tanah = data[i].lt;
                        document.getElementById('lt').value = luas_tanah;

                        var harga_jual = data[i].harga_jual;
                        if (isNaN(harga_jual)) {
                        document.getElementById('harga_jual').value = parseInt(harga_jual) * 1000000;
                        } else {
                            document.getElementById('harga_jual').value = harga_jual;

                        };
                        
                        var luas_bangunan = data[i].lb;
                        document.getElementById('luas_bangunan').value = luas_bangunan;
                        
                    };
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
            var total = harga_jual  - potongan;
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