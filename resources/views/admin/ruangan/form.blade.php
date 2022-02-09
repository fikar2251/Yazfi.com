<input type="hidden" name="cabang_id" value="{{ $ruangan->cabang_id ?? $cabang->id }}">
<div class="form-group">
    <label>Nama Ruangan</label>
    <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" value="{{ $ruangan->nama_ruangan ?? '' }}">

    @error('nama_ruangan')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
</div>