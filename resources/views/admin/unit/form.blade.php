<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama Unit</label>
            <input type="text" name="nama" value="{{$unit ? $unit->nama : ''}}" class="form-control">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_perusahaan">Perusahaan</label>
            <select name="id_perusahaan" id="id_perusahaan" class="form-control" required="">
                <option disabled selected>-- Select Perusahaan --</option>
                @foreach($perusahaans as $perusahaan)
                <option {{ $unit->id_perusahaan == $perusahaan->id ? 'selected' : '' }} value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                @endforeach
            </select>

            @error('id_perusahaan')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


    </div>
    
</div>
<div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
</div>