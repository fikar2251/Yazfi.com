@extends('layouts.master', ['title' => 'Payment'])

@section('content')
    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">INPUT PEMBAYARAN KONSUMEN</h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="tanggal_transaksi" id="tanggal_transaksi"
                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET">
        <div class="form-group row d-flex justify-content-center mt-2">
            <label for="name" class="col-sm-2">Masukkan nomor SPR :</label>
            <div class="col-sm-2">
                <select name="no_transaksi" id="spr" class="form-control">
                    @if (!request()->get('no_transaksi'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($spr as $item)
                        @if (request()->get('no_transaksi') == $item->no_transaksi)
                            <option value="{{ $item->no_transaksi }}" selected>{{ $item->no_transaksi }}</option>
                        @else
                            <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </form>

    @if (request()->get('no_transaksi'))
        <form action="{{ route('supervisor.payment.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 container">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        @foreach ($getSpr as $item)
                                            <tr>
                                                <th style="width: 200px">NO SPR</th>
                                                <th style="width: 20px">:</th>
                                                <th> <input type="hidden" name="no_transaksi"
                                                        value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</th>
                                            </tr>
                                        @endforeach
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 200px">Konsumen</td>
                                            <td style="width: 20px">:</td>
                                            <td>{{ $item->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Tanggal Pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Nominal</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <input type="number" name="nominal" id="nominal" class="form-control"
                                                    style="width: 200px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <select name="rincian_id" id="rincian_id" class="form-control rincian"
                                                    style="width: 200px">
                                                    <option selected value="">-- Pembayaran --</option>
                                                    @foreach ($tagihan as $item)
                                                        {{-- <option value="{{ $item->id_rincian }}"> --}}
                                                        @if ($item->tipe == 1 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">Booking fee</option>
                                                        @elseif ($item->tipe == 1 && $item->status_pembayaran == 'paid')
                                                            <option hidden value="{{ $item->id_rincian }}">Booking fee
                                                            </option>
                                                        @elseif ($item->tipe == 2 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">Downpayment</option>
                                                        @elseif ($item->tipe == 2 && $item->status_pembayaran == 'paid')
                                                            <option hidden value="{{ $item->id_rincian }}">Downpayment
                                                            </option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}</option>
                                                            </option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'partial')
                                                            <option value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}</option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'paid')
                                                            <option hidden value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}
                                                            </option>
                                                        @endif
                                                        {{-- </option> --}}
                                                    @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Bank tujuan</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <select name="bank_tujuan" id="bank_tujuan" class="form-control rincian"
                                                    style="width: 200px">
                                                    <option selected value="">-- Bank tujuan --</option>
                                                    <option value="Bri">BRI</option>
                                                    <option value="Bca">BCA</option>
                                                    <option value="Mandiri">Mandiri</option>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                    Save</button>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12" style="text-align: center">
                    <h4 class="page-title">Riwayat Pembayaran</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card shadow" style="margin-left: 180px">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Tanggal Jatuh tempo</th>
                                            <th>Nominal</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($tagihan as $item)
                                            <tr>
                                                <td>{{ $item->id_rincian }}</td>
                                                <td>{{ $item->jatuh_tempo }}</td>
                                                <td>@currency($item->jumlah_tagihan)</td>
                                                <td>
                                                    {{ $item->keterangan }}
                                                </td>
                                                <td>
                                                    @if ($item->status_pembayaran == 'partial')
                                                        <span class="btn-danger">unpaid</span>
                                                    @elseif($item->status_pembayaran == 'unpaid')
                                                        <span class="btn-danger">unpaid</span>
                                                    @elseif($item->status_pembayaran == 'paid')
                                                        <span
                                                            class="btn-success">{{ $item->status_pembayaran }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        @foreach ($bayar as $item)
        @endforeach
        @if ($item->id)
            <div class="row mt-5">
                <div class="col-sm-12" style="text-align: center">
                    <h4 class="page-title">Konfirmasi Pembayaran</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="card shadow" style="margin-left: 180px">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal transaksi</th>
                                            <th>Tipe</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Bank tujuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bayar as $item)
                                            <tr>
                                                <td>{{ $item->no_detail_transaksi }}</td>
                                                <td>{{ $item->tanggal_transaksi }}</td>
                                                <td>
                                                    {{ $item->rincian->keterangan }}
                                                </td>
                                                <td>
                                                    @currency($item->nominal)
                                                </td>
                                                <td>
                                                    @if ($item->bank_tujuan == 'Bri')
                                                        BRI
                                                    @elseif ($item->bank_tujuan == 'Bca')
                                                        BCA
                                                    @else
                                                        Mandiri
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status_approval == 'pending')
                                                        <span class="btn-danger">{{ $item->status_approval }}</span>
                                                    @elseif ($item->status_approval == 'paid')
                                                        <span class="btn-success">{{ $item->status_approval }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="{{ route('supervisor.payment.delete', $item->id) }}">
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
    @else
    @endif
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.rincian').change(function() {
                var rincian_id = $(this).val();
                var nominal = $(this).val();
                var div = $(this).parent();
                var op = " ";

                console.log(rincian_id);
                $.ajax({
                    url: `/supervisor/nominal`,
                    method: "get",
                    data: {
                        'rincian_id': rincian_id,
                        'nominal': nominal,
                    },

                    success: function(data) {
                        // if (data) {
                        console.log(data);

                        for (var i = 0; i < data.length; i++) {
                            if (data[i].jumlah_tagihan) {
                                var nominal = data[i].jumlah_tagihan;
                            } else {

                                var nominal = data;
                            }
                            document.getElementById('nominal').value = nominal;
                        };
                        // } 
                        // else if(data2) {
                        //     console.log(data2);

                        //     for (var i = 0; i < data2.length; i++) {

                        //         // var nominal = data2[i].jumlah_tagihan;
                        //         var nominal = data2;
                        //         document.getElementById('nominal').value = nominal;
                        //     };  
                        // }  
                        // else {
                        //     console.log('halo');    
                        // }                      
                    },
                    error: function() {

                    },

                    // success: function(data) {
                    //     console.log(data);

                    //     for (var i = 0; i < data.length; i++) {

                    //         var nominal = data[i].jumlah_tagihan;
                    //         // var nominal = data;
                    //         document.getElementById('nominal').value = nominal;
                    //     };
                    // },
                    // error: function() {

                    // },

                })
            })
        })
    </script>
@stop
