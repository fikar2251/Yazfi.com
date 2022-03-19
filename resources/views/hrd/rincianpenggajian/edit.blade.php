@extends('layouts.master', ['title' => 'Edit Rincian Gaji'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <a href="{{ route('hrd.rincianpenggajian.index') }} " class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('hrd.rincianpenggajian.update', $gajian->id) }}" method="post" id="form">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="id_role">Nama Roles </label>
                                        <select name="id_role" id="roles" class="form-control">
                                            {{-- @foreach($gajian->roles as $rol)
                                            <option selected value="{{ $rol->id }}">{{ $rol->key }}</option>
                                            @endforeach --}}
                                            @foreach($roles as $role)
                                            <option {{ $gajian->id_role == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                                {{ $role->key }}</option>
                                            @endforeach
                                        </select>
                    
                                        @error('id_role')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="gaji">Gaji</label>
                                        <input type="text" id="gaji" required="" name="gaji" value="{{$gajian ? $gajian->gaji : ''}}"
                                            class="form-control">
                    
                                        @error('gaji')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <script type="text/javascript">
                            
                        var rupiah = document.getElementById('rupiah');
                        rupiah.addEventListener('keyup', function(e){
                            // tambahkan 'Rp.' pada saat form di ketik
                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                            rupiah.value = formatRupiah(this.value, 'Rp. ');
                        });
                    
                        /* Fungsi formatRupiah */
                        function formatRupiah(angka, prefix){
                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                            split   		= number_string.split(','),
                            sisa     		= split[0].length % 3,
                            rupiah     		= split[0].substr(0, sisa),
                            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                    
                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                            if(ribuan){
                                separator = sisa ? '.' : '';
                                rupiah += separator + ribuan.join('.');
                            }
                    
                            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                        }
                    </script>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-1 offset-sm-0">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
       
        </div>
    </div>
</div>
@stop
