@extends('layouts.master', ['title' => 'Payment'])

@section('content')
    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">INPUT PEMBAYARAN KONSUMEN</h4>
            <div class="text-center">
                {{-- <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_transaksi" id="tanggal" value="{{ $nourut }}">
                    </div>
                </div> --}}
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
                    <option selected value=""></option>
                    @foreach ($spr as $item)
                        <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</option>
                    @endforeach
                </select>

                {{-- {{ request()->get('no_transaksi') }} --}}

                {{-- <input type="text" name="spr" id="spr" class="form-control"> --}}
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
                                            <th>{{ $item->no_transaksi }}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 200px">Konsumen</td>
                                        <td style="width: 20px">:</td>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
    @endforeach
    <tr>
        <td style="width: 200px">Tanggal Pembayaran</td>
        <td style="width: 20px">:</td>
        <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td style="width: 200px">Nominal</td>
        <td style="width: 20px">:</td>
        <td>
            <input type="number" name="nominal" id="nominal" class="form-control" style="width: 200px">
        </td>
    </tr>
    <tr>
        <td style="width: 200px">Tujuan</td>
        <td style="width: 20px">:</td>
        <td>
            <select name="tujuan" id="tujuan" class="form-control" style="width: 200px">
                <option selected value="">-- Tujuan --</option>
                <option value="DP">DP</option>
                <option value="Booking Fee">Booking Fee</option>
                <option value="Cicilan">Cicilan</option>
            </select>
        </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-4">
            <h4 class="page-title">Riwayat Pembayaran</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped">
                            <thead>
                                <tr>

                                    <th>NO</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Tipe</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tagihan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        <td>{{ $item->jumlah_tagihan }}</td>
                                        <td>


                                            @if ($item->tipe == 1)
                                                Booking fee
                                            @elseif ($item->tipe == 2)
                                                Downpayment
                                            @else

                                            Pembayaran cicilan tahap {{($loop->iteration)- 2}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_pembayaran == 'unpaid')
                                                Pending
                                            @else
                                                Approval
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
@else

    @endif




@stop
