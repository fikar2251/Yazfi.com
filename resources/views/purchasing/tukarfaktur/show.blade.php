@extends('layouts.master', ['title' => 'Show Pengajuan Dana'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Tukar Faktur</h4>
    </div>
    <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm ">
           
            <a href="{{ route('purchasing.tukarfaktur.pdf',$detail->id) }}" class="btn btn-success btn-sm">Export to PDF</a>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-10 body-main">
            <div class="col-md-12">
                <div class="card shadow" id="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-logo">
                                    <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                </div>
                            </div>
                            <div class="col-md-8">
                               
                            </div>
                        </div><br>
                        <br />
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="font-size: 12px">Nama Vendor :
                                                <a>
                                                    <td>{{ $detail->nama }}</td>
                                                </a>
                                            </p style="font-size: 12px">
                                            <p style="font-size: 12px">Nilai Invoice :
                                                <a style="font-size: 12px">
                                                    @currency($detail->nilai_invoice)
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Keterangan Pembayaran :
                                                <a style="font-size: 12px">
                                                    <td>{{$detail->status_pembayaran}}</td>
                                                </a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="font-size: 12px">No Faktur :
                                                <a style="font-size: 12px">
                                                    <td>{{$detail->no_faktur}}</td>
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Tanggal Tukar Faktur : <a style="font-size: 12px">{{ Carbon\Carbon::parse($detail->tanggal_tukar_faktur)->format('d/m/Y H:i:s') }}
                                                </a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th class=" text-light">No.</th>
                                            <th class="text-light">Kelengkapan Dokumen</th>
                                            <th class="text-light">Ada</th>
                                            <th class="text-light">Tidak Ada</th>
                                            <th class="text-light"> Catatan</th>
                                        </tr>
                                        <tbody>
                                            @foreach(App\DetailTukarFaktur::where('no_faktur', $detail->no_faktur)->get() as $dokumens)
                                            <tr style="font-size:12px;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dokumens->data->nama_dokumen }}</td>
                                                <td>{{ $dokumens->pilihan == 'Y'}}</td>
                                                <td>{{ $dokumens->pilihan == 'T'}}</td>
                                                <td>{{ $dokumens->catatan }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="margin-top:20px;font-size:12px;" class="text-center">Pengirim,</p>
                                            <br>
                                            <br>
                                            <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">(.......................................)</p>
                                            <p style="margin-top: -10px;font-size:12px;" class="text-center m-b-2">Nama Jelas</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <p style="margin-top:20px;font-size:12px;" class="text-center">Penerima,</p>
                                            <br>
                                            <br>
                                            <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">(.......................................)</p>
                                            <p style="margin-top: -10px; font-size:12px;" class="text-center m-b-2">Nama Jelas</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-sg-4 m-b-4">

                                <div class="form-group">
                                    <p class="text-left" style="text-decoration:underline;font-size:10px;"><strong>Syarat Tukar Faktur</strong></p>
                                    <ul style="list-style-type: square; margin-top:-15px;margin-left:-15px;font-size:10px;">
                                        <li>Peneromaan tukar faktur setiap hari Selasa dan Kamis jam 10.00 s/d jam 15.00 WIB</li>
                                        <li>Pembayaran direalisasikan setiap hari selasa</li>
                                        <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                        <li>Divisi keuangan berhak menolak dokumen tagihan jika terdapat kekurangan dokumen dan</li>
                                        <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                        <li>adanya kesalahan ketik atau perhitungan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
<script>
    function myFunction() {
        document.getElementById(" demo").innerHTML = "YOU CLICKED ME!";
    }
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'copy',
            className: 'btn-default',
            exportOptions: {
                columns: ':visible'
            }
        }, {
            extend: 'excel',
            className: 'btn-default',
            title: 'Laporan Pembelian ',
            messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
            footer: true,
            exportOptions: {
                columns: ':visible'
            }
        }, {
            extend: 'pdf',
            className: 'btn-default',
            title: 'Laporan Pembelian ',
            messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
            footer: true,
            exportOptions: {
                columns: ':visible'
            }
        }, ]
    });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    var formatter = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 13,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    // document.getElementById('submit').disabled = true
    function form_dinamic() {
        let index = $('#dynamic_field tr').length + 1
        document.getElementById('counter').innerHTML = index
        let template = `
        <tr class="rowComponent">
                    <td hidden>
                        <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
                    </td>
                    <td>
                        <select required name="barang_id[${index}]" id="${index}" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="number" name="qty[${index}]"  class="form-control qty-${index}" placeholder="0">
                    </td>
                    <td>
                        <input type="number" name="harga_beli[${index}]" class="form-control harga_beli-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this), HowAboutIt(this)">
                    </td>
                    <td>
                        <input type="number" name="total[${index}]" disabled class="form-control total-${index} total-form"  placeholder="0">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="remove(this)">Delete</button>
                    </td>
                </tr>
        `
        $('#dynamic_field').append(template)
        $(`.select-${index}`).select2({
            placeholder: 'Select Product',
            ajax: {
                url: `/admin/where/product`,
                processResults: function(data) {
                    console.log(data)
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    function remove(q) {
        $(q).parent().parent().remove()
    }
    $('.remove').on('click', function() {
        $(this).parent().parent().remove()
    })

    function hitung(e) {
        let harga = e.value
        let attr = $(e).attr('data')
        let qty = $(`.qty-${attr}`).val()
        let total = parseInt(harga * qty)
        $(`.total-${attr}`).val(total)
    }

    function HowAboutIt(e) {
        let sub_total = document.getElementById('sub_total')
        let total = 0;
        let coll = document.querySelectorAll('.total-form')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        sub_total.value = total
        let tax = (10 / 100) * sub_total.value;
        let total_all = parseInt(tax);
        // rupiah()
        document.getElementById('PPN').value = total_all;
    }
    $(document).ready(function() {
        $('#add').on('click', function() {
            form_dinamic()
        })
    })
    $(document).ready(function() {
        $('.dynamic').change(function() {
            var id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                url: `/logistik/where/project`,
                method: "get",
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    op += '<option value="0" selected disabled> Lokasi</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].alamat_project + '">' + data[i].alamat_project + '</option>'
                    };
                    $('.root3').html(op);
                },
                error: function() {}
            })
        })
    })
</script>
@stop