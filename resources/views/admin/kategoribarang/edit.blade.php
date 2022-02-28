@extends('layouts.master', ['title' => 'Kategori Barang'])

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Edit Kategori Barang</h4>
    </div>
</div>

<form action="{{ route('admin.kategoribarang.update', $kategori->id) }}" method="post">
    @method('PATCH')
    @csrf
    <div class="col-sm-6 col-sg-4 m-b-4">
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" required="" name="nama_kategori" id="nama_kategori" class="form-control"
                value="{{ $kategori->nama_kategori ?? '' }}">
    
            @error('nama_kategori')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6 col-sg-4 m-b-4">
        <div class="form-group">
            <label for="created_at">Tanggal</label>
            <input type="datetime-local" name="created_at" id="created_at" class="form-control"
                value="{{Carbon\Carbon::parse($kategori->created_at)->format('Y-m-d').'T'.Carbon\Carbon::parse($kategori->created_at)->format('H:i:s')}}">
    
            @error('created_at')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-6 col-sg-4 m-b-4 text-left">
        <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
    </div>
    
</form>
@stop
