<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kode_cabang">Kode Cabang</label>
            <input type="text" name="kode_cabang" id="kode_cabang" class="form-control" value="{{ $cabang->kode_cabang }}">

            @error('kode_cabang')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="a" class="form-control" value="{{ $cabang->nama }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="telpon">Telp</label>
            <input type="number" name="telpon" id="telpon" class="form-control" value="{{ $cabang->telpon }}">

            @error('telpon')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="pajak">Status Pajak</label> <br>
            <label>
                <input type="checkbox" name="pajak" id="pajak" value="{{ $cabang->status_pajak ?? 0 }}" {{ $cabang->status_pajak == 1 ? 'checked' : '' }}>
            </label>

            @error('pajak')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $cabang->email }}">

            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="whatsapp">Whatsapp</label>
            <input type="number" name="wa" id="whatsapp" class="form-control" value="{{ $cabang->wa }}">

            @error('wa')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="ppn">PPN <small>*%</small></label>
            <input type="number" name="ppn" id="ppn" class="form-control" value="{{ $cabang->ppn ?? 0 }}">

            @error('ppn')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{ $cabang->alamat }}</textarea>

            @error('alamat')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>
</div>

<div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
</div>