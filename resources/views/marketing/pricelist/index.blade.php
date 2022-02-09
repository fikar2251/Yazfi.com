@extends('layouts.master', ['title' => 'Pricelist'])
@section('content')
@php

use App\Marketing;

$stok = Marketing::all('type')->take(20);
$type = Marketing::where('type', 'Ruko')->orderBy('type', 'desc')->take(1)->get();
$stock = DB::table('unit_rumah')->select('type')->distinct()->get();
@endphp
<div class="row">
    <div class=" col text-center">
        <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-2">SURAT PEMESANAN RUMAH</h4>
        <h5>Nomor : </h5>
        <h5>Tanggal : </h5>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered custom-table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Cabang</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
<td>{{ $data->nama_barang }}</td>
<td>
    <ul class="list-unstyled">
        @foreach($data->produkharga as $row)
        <li>{{ $row->cabang->nama }}</li>
        @endforeach
    </ul>
</td>
<td>
    <ul class="list-unstyled">
        @foreach($data->produkharga as $row)
        <li>Rp. {{ number_format($row->harga) }}</li>
        @endforeach
    </ul>
</td>
<td>
    {{ $data->durasi }}
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div> --}}

<div class="row mt-5">
    <div class="col-sm-4">
        <h4 class="page-title">I. Data Pembeli</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control">

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">No KTP</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">NPWP</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" rows="3" class="form-control"></textarea>

            @error('address')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="phone_number">No. Telp</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">No. HP</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

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
            <input type="email" name="email" id="email" class="form-control">

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
            <select name="type" id="type" class="form-control">
                <option disabled selected>-- Select Type --</option>
                @foreach ($stock as $item)
                <option value="{{$item->type}}">{{$item->type}}</option>
                @endforeach
            </select>

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Blok</label>
            {{-- <input type="number" name="phone_number" id="phone_number" class="form-control" value=""> --}}
            <select name="blok" id="blok" class="form-control">

                <option disabled selected>-- Select Blok --</option>
            </select>

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Luas tanah</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Harga Jual</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Potongan</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Harga Net</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="phone_number">Luas bangunan</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Penambahan Luas Tanah</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Total Luas Tanah</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


    </div>
</div>
<div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
</div>

@stop