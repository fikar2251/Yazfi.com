@extends('layouts.master', ['title' => 'Refund'])
@section('content')

   @php

    use App\Marketing;
    use App\Spr;
    use App\Pembatalan;

    $AWAL = 'RF';
    $noUrutAkhir = Pembatalan::max('id');

    $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">FORM INPUT REFUND </h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_transaksi" id="tanggal" value="{{ $nourut }}">
                    </div>
                </div>
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
            <label for="name" class="col-sm-2">Masukkan nomor pembatalan :</label>
            <div class="col-sm-2">
                <select name="no_pembatalan" id="no_pembatalan" class="form-control">
                    {{-- @if (!request()->get('no_transaksi'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($spr as $item)
                        @if (request()->get('no_transaksi') == $item->no_transaksi)
                            <option value="{{ $item->no_transaksi }}" selected>{{ $item->no_transaksi }}</option>
                        @else
                            <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</option>
                        @endif
                    @endforeach --}}
                    <option value=""> -- No batal --</option>
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

    @if (request()->get('no_pembatalan'))
        <form action="{{ route('supervisor.cancel.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 container">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        {{-- @foreach ($getSpr as $item) --}}
                                        <tr>
                                            <th style="width: 200px">No Refund</th>
                                            <th style="width: 20px">:</th>
                                            <th> {{ $nourut }} <input type="hidden" name="no_transaksi" value="">
                                            </th>

                                        </tr>
                                        {{-- @endforeach --}}
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 200px">No Pembatalan</td>
                                            <td style="width: 20px">:</td>
                                            <td> </td>
                                        </tr>
                                        {{-- @foreach ($getSpr as $item) --}}
                                            <tr>
                                                <td style="width: 200px">Konsumen</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{-- @currency($item->harga_net) --}}
                                                </td>
                                            </tr>
                                        {{-- @endforeach --}}
                                        <tr>
                                            <td style="width: 200px">Sales</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- {{ $item->unit->type }} <input type="hidden" name="id_spr"
                                                    value="{{ $item->id_transaksi }}"> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Spv</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- {{ $item->unit->lt }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Tanggal</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                               {{ Carbon\Carbon::now()->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Total yang sudah dibayar</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- {{ $item->user->name }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Potongan</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- {{ auth()->user()->name }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Total refund</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- <select name="alasan" id="alasan" class="form-control"
                                                    style="width: 200px">
                                                    <option value="">-- Pilih alasan --</option>
                                                    @foreach ($alasan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->alasan }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Status</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- <textarea name="keterangan" id="keterangan" cols="30" rows="5"></textarea> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Sumber pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{-- <textarea name="keterangan" id="keterangan" cols="30" rows="5"></textarea> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Ditransfer ke rekening</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <textarea name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
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
        </form>
    @else
    @endif


@stop
