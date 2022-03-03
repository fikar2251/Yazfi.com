@extends('layouts.master', ['title' => 'Create Tukar Faktur Barang'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Tukar Faktur</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <div class="dashboard-logo">
                            <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <div class="invoice-details">
                            <h3 class="text-uppercase"></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong></strong></h5>
                            </li>
                            <li><span></span></li>
                        </ul>
                    </div>
                </div>
                <form action="" method="get">

                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_po">No Purchasing Order <span style="color: red">*</span></label>

                                        <select id="invoice" name="invoice" data-dependent="barang_id"
                                            class="form-control dynamic_function">
                                            @if (!request()->get('invoice'))
                                            <option selected value="Select Nomor PO"></option>
                                            @endif
                                            @foreach ($purchase as $item)
                                            @if (request()->get('invoice') == $item->invoice)
                                            <option value="{{ $item->invoice }}" selected>{{ $item->invoice }}</option>
                                            @else
                                            <option value="{{ $item->invoice }}">{{ $item->invoice }}</option>
                                            @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" id="id">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4" style="margin-top: 32px">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
                @if (request()->get('invoice'))
                <form action="{{ route('purchasing.tukarfaktur.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">No PO <span style="color: red">*</span></label>
                                        <input class="form-control dynamic_function" data-dependent="supplier_id"
                                            type="search" maxlength="8" minlength="8" id="no_po">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">Tanggal Faktur <span style="color: red">*</span></label>
                                        <input type="datetime-local" name="tanggal_tukar_faktur" id="tanggal"
                                            class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">No Tukar Faktur <span style="color: red">*</span></label>
                                        <input type="text" name="no_faktur" value="" id="invoice" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_po">Jika No PO Ditemukan Muncul Halaman Dibawah Ini <span
                                                style="color: red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_faktur">Nama Vendor <span style="color: red">*</span></label>
                                        <input type="text" name="supplier_id" value="" id="supplier_id"
                                            class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_po"> <span style="color: red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_faktur">No Faktur <span style="color: red">*</span></label>
                                        <input type="text" name="no_faktur" value="" id="invoice" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">Nilai Invoice <span style="color: red">*</span></label>
                                        <input type="text" name="nilai_invoice" value="" id="grandtotal"
                                            class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Tukar Faktur <span
                                                style="color: red">*</span></label>
                                        <input type="datetime-local" name="tanggal_tukar_faktur" id="tanggal"
                                            class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="invoice">PO Number <span style="color: red">*</span></label>
                                        <input type="text" name="no_po_vendor" value="" id="invoice"
                                            class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <label for="invoice"><strong> Checkbox Pilih Salah Satu</strong> <span
                                        style="color: red">*</span></label>
                                <table class="table table-bordered  report">
                                    <tr style="font-size:12px;" class="bg-success">
                                        <th class=" text-light">No.</th>
                                        <th class="text-light">Kelengkapan Dokumen</th>
                                        <th class="text-light">Ada</th>
                                        <th class="text-light">Tidak Ada</th>
                                        <th class="text-light"> Catatan</th>
                                    </tr>
                                    <tbody>
                                        @foreach($purchasing as $barang)
                                        <tr style="font-size:12px;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->nama_dokumen }}</td>
                                            <td>
                                                <input name="pilihan" type="checkbox" id="pilihanYa" value="Y"
                                                    data-binding-checked="">
                                            </td>
                                            <td>
                                                <input name="pilihan" type="checkbox" id="pilihanTidak" value="T"
                                                    data-binding-checked="">
                                            </td>
                                            <td>
                                                <input type=" text" name="keterangan" class="form-control"
                                                    placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <br>
        @else
        @endif
    </div>
</div>




</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    var formatter = function (num) {
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
        // let template = `
        // <tr class="rowComponent">
        //             <td hidden>
        //                 <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
        //             </td>
        //             <td>
        //                 <select required name="barang_id[${index}]" id="${index}" class="form-control select-${index}"></select>
        //             </td>
        //             <td>
        //                 <input type="number" name="qty[${index}]"  class="form-control qty-${index}" placeholder="0">
        //             </td>
        //             <td>
        //                 <input type="number" name="harga_beli[${index}]" class="form-control harga_beli-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this)">
        //             </td>
        //             <td>
        //                 <input type="number" name="total[${index}]" disabled class="form-control total-${index} total-form"  placeholder="0">
        //             </td>
        //             <td>
        //                 <button type="button" class="btn btn-danger btn-sm" onclick="remove(this)">Delete</button>
        //             </td>
        //         </tr>
        // `
        $('#dynamic_field').append(template)

        $(`.select-${index}`).select2({
            placeholder: 'Select Product',
            ajax: {
                url: `/admin/where/product`,
                processResults: function (data) {
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
    $('.remove').on('click', function () {
        $(this).parent().parent().remove()
    })


    $(document).ready(function () {
        $('#add').on('click', function () {
            form_dinamic()
        })
    })
    $(document).ready(function () {
        $('.dynamic_function').change(function () {
            var invoice = $(this).val();
            var id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(invoice);
            $.ajax({
                url: `/purchasing/where/penerimaan/search`,
                method: "get",
                data: {
                    'id': id,
                    'invoice': invoice,
                },
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        var id = data[i].id;
                        // console.log(supplier_id);
                        document.getElementById('id').value = id;

                        var supplier_id = data[i].supplier_id;
                        // console.log(supplier_id);
                        document.getElementById('supplier_id').value = supplier_id;
                        document.getElementById('supplier_id').defaultvalue =
                            supplier_id;

                        var project_id = data[i].project_id;
                        // console.log(project_id);
                        document.getElementById('project_id').value = project_id;
                        document.getElementById('project_id').defaultvalue = project_id;

                        var lokasi = data[i].lokasi;
                        // console.log(lokasi);
                        document.getElementById('lokasi').value = lokasi;
                        document.getElementById('lokasi').defaultvalue = lokasi;

                        var created_at = data[i].created_at;
                        // console.log(created_at);
                        document.getElementById('created_at').value = created_at;
                        document.getElementById('created_at').defaultvalue = created_at;


                    };
                },
                error: function () {}
            })
        })
    })

    function testNum(e) {
        let result = 0;
        let attr = $(e).attr('data')
        let qty_received = $(`.qty_received-${attr}`).val()
        console.log(qty_received)
        let qty = $(`.qty-${attr}`).val()
        console.log(qty)

        if (qty > qty_received) {
            result = 'partial'
        } else {
            result = 'completed';
        }

        $(`.status_barang-${attr}`).val(result)

        // console.log(status_barang);
        // let coll = document.querySelectorAll('.status-form')
        // for (let i = 0; i < coll.length; i++) {
        //     let ele = coll[i]
        //     status_barang += parseInt(ele.value)
        // }
        // document.getElementById("status_barang").value = result;

        // console.log(status_barang)


    }

    // function tesNumIT(e) {


    //     let status_barang = 0;
    //     let coll = document.querySelectorAll('.status-form')
    //     for (let i = 0; i < coll.length; i++) {
    //         let ele = coll[i]
    //         status_barang += parseInt(ele.value)
    //     }
    //     let SUB = document.getElementById(status_barang);

    // }

</script>
@stop
