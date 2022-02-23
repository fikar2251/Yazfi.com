<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{ $barangs ? $barangs->kode_barang: ''}}">

            @error('kode_barang')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $barangs ? $barangs->nama_barang : '' }}">

            @error('nama_barang')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $barangs ? $barangs->description : '' }}">

            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis">Jenis</label> <br>
            <label>
                <input type="checkbox" name="jenis" id="jenis" value="{{ $barangs->jenis ?? 0 }}" {{ $barangs->jenis == 1 ? 'checked' : '' }}> Service
            </label>
            <label>
                <input type="checkbox" name="jenis" id="jenis" value="{{ $barangs->jenis ?? 0 }}" {{ $barangs->jenis == 0 ? 'checked' : '' }}> Barang
            </label>

            @error('jenis')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $barangs ? $barangs->type : '' }}">
            
            @error('type')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
    </div>
</div>

<div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
</div>