<div class="row">
    <div class="col-sm-6 col-lg-4 m-b-20">
        <ul class="list-unstyled">
            <li>
                <div class="form-group">
                    <label for="supplier">Nama Jabatan *</label>
                    <input type="text" name="nama" value="$jabatan ? $jabatan->nama : ''" class="form-control">
                </div>
            </li>
        </ul>
    </div>
    <div class="form-group">
        <label for="perusahaan">Perusahaan</label>
        <select name="id_perusahaan" id="perusahaan" class="form-control">
            <option disabled selected>-- Select Perusahaan --</option>
            @foreach($perusahaans as $perusahaan)
            <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
            @endforeach
        </select>

        @error('id_jabatan')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>