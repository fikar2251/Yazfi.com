@extends('layouts.master', ['title' => 'Pricelist'])
@section('content')
@php

use App\Marketing;


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
            <select name="type" id="type" class="form-control dynamic" data-dependent="blok">
                <option value="">-- Select Type --</option>
                @foreach ($blok as $item)
                <option value="{{$item->type}}">{{$item->type}}</option>
                @endforeach
            </select>

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Blok</label>
            <select name="blok" id="blok" class="form-control dinamis root2" data-dependent="no">
                <option value=""></option>
            </select>

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">No.</label>
            <select name="no" id="no" class="form-control lt root1" data-dependent="lt">
                <option value=""></option>
            </select>

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Luas tanah</label>
            <select name="lt" id="lt" class="form-control root3">
                <option value="">-- Select Lt --</option>
            </select>
            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{ csrf_field() }}
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

</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" --}}
<script>
    $(document).ready(function() {
        $('.dynamic').change(function() {

            var type = $(this).val();
            var blok = $(this).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                url: `/marketing/blok`,
                method: "get",
                data: {
                    'type': type,
                    'blok': blok,
                    'no': no,
                    'lt': lt,
                },
                success: function(data) {
                    console.log(data);
                    op += '<option value="0">--Select Blok--</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].blok + '">' + data[i].blok + '</option>'
                    };
                    $('.root2').html(op);
                },
                error: function() {

                }
            })
        })
    })
    $(document).ready(function() {
        $('.dinamis').change(function() {

            var blok = $(this).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                url: `/marketing/no`,
                method: "get",
                data: {
                    'blok': blok,
                    'no': no,
                    'lt' : lt
                },
                success: function(data) {
                    console.log(data);
                    op += '<option value="0">--Select No--</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].no + '">' + data[i].no + '</option>'
                    };
                    $('.root1').html(op);
                },
                error: function() {

                },
                // success: function(lt) {
                //     console.log(lt);
                //     op += '<option value="0">--Select No--</option>';
                //     for (var i = 0; i < lt.length; i++) {
                //         op += '<option value="' + lt[i].no + '">' + lt[i].no + '</option>'
                //     };
                //     $('.root3').html(op);
                // }
            })
        })

        $('.lt').change(function() {
            console.log('test');
            var blok = $(this).val();
            var no = $(this).val();
            var lt = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(no);
            console.log(blok);
            $.ajax({
                url: `/marketing/no`,
                method: "get",
                data: {
                    'no': no,
                    'blok': blok,
                    'lt' : lt
                },
                
                // success: function(data) {
                //     console.log(data);
                //     op += '<option value="0">--Select No--</option>';
                //     for (var i = 0; i < data.length; i++) {
                //         op += '<option value="' + data[i].no + '">' + data[i].no + '</option>'
                //     };
                //     $('.root1').html(op);
                // },
                // error: function() {

                // },
                success: function(lt) {
                    console.log(lt);
                    op += '<option value="0">--Select Lt--</option>';
                    for (var i = 0; i < lt.length; i++) {
                        op += '<option value="' + lt[i].lt + '">' + lt[i].lt + '</option>'
                    };
                    $('.root3').html(op);
                }
            })
        })
    })

    // $(document).ready(function() {
        

    //     $('.lt').change(function() {
    //         var no = $(this).val();
    //         var lt = $(this).val();
    //         var div = $(this).parent();
    //         var op = " ";
    //         console.log(no);
    //         console.log(lt);
    //         $.ajax({
    //             url: `/marketing/lt`,
    //             method: "get",
    //             data: {
    //                 'no': no,
    //                 'lt': lt
    //             },
    //             success: function(lt) {
    //                 console.log(lt);
    //                 op += '<option value="0">Select Lt</option>';
    //                 for (var i = 0; i < lt.length; i++) {
    //                     op += '<option value="' + lt[i].lt + '">' + lt[i].lt + '</option>'
    //                 };
    //                 $('.root3').html(op);
    //             },
    //             error: function() {

    //             }
    //         })
    //     })
    // })
</script>
{{-- <script>
//     $(document).ready(function(){
    
//     $('.dinamis').change(function(){
//     if($(this).val() != '')
//     {
//         console.log('test');
//     var select = $(this).attr("id");
//     var value = $(this).val();
//     var dependent = $(this).data('dependent');
//     var _token = $('input[name="_token"]').val();
//     $.ajax({
//         url:"{{ url('/marketing/fetch') }}",
// // url:`/pricelist/fetch`,
// method:"POST",
// data:{select:select, value:value, _token:_token, dependent:dependent},
// success:function(result)
// {
// console.log(result)
// $('#'+dependent).html(result);
// }

// })
// }
// });

// $('#blok').change(function(){
// $('#no').val('');
// $('#lt').val('');
// });

// $('#no').change(function(){
// $('#lt').val('');
// });


// });


// </script> --}}

@stop