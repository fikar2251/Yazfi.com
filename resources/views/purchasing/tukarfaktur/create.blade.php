@extends('layouts.master', ['title' => 'Create Tukar Faktur'])
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

                <form action="{{ route('purchasing.tukarfaktur.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">No PO <span style="color: red">*</span></label>
                                        <input class="form-control dynamic_function" data-dependent="supplier_id" type="search" maxlength="8" minlength="8" id="no_po">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="no_faktur">Tanggal Faktur <span style="color: red">*</span></label>
                                        <input type="datetime-local" name="tanggal_tukar_faktur" id="tanggal" class="form-control">
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
                                        <label for="no_po">Jika No PO Ditemukan Muncul Halaman Dibawah Ini <span style="color: red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_faktur">Nama Vendor <span style="color: red">*</span></label>
                                        <input type="text" name="supplier_id" value="" id="supplier_id" class="form-control">
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
                                        <input type="text" name="nilai_invoice" value="" id="grandtotal" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Tukar Faktur <span style="color: red">*</span></label>
                                        <input type="datetime-local" name="tanggal_tukar_faktur" id="tanggal" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="invoice">PO Number <span style="color: red">*</span></label>
                                        <input type="text" name="no_po_vendor" value="" id="invoice" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <label for="invoice"><strong> Checkbox Pilih Salah Satu</strong> <span style="color: red">*</span></label>
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
                                                <input name="pilihan" type="checkbox" id="pilihanYa" value="Y" data-binding-checked="">
                                            </td>
                                            <td>
                                                <input name="pilihan" type="checkbox" id="pilihanTidak" value="T" data-binding-checked="">
                                            </td>
                                            <td>
                                                <input type=" text" name="keterangan" class="form-control" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" id="add" class="btn btn-primary mb-2">Tambah Row Baru</button>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover border" id="table-show">
                                    <tr class="bg-success">
                                        <th class="text-light">ITEM</th>
                                        <th class="text-light">QTY</th>
                                        <th class="text-light">HARGA BELI</th>
                                        <th class="text-light">TOTAL</th>
                                        <th class="text-light">#</th>
                                    </tr>
                                    <tbody id="dynamic_field">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <p class="text-info">*Mohon Untuk Input Dengan Benar dan Berurut : <span class="badge badge-primary" id="counter"></span></p>
                    <div class="row invoice-payment">
                        <div class="col-sm-4 offset-sm-8">
                            <h6>Total due</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" id="sub_total" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>PPN 10%</label>
                                        <input type="text" id="PPN" name="PPN" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 offset-sm-8">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </div> -->
            </div>
            <br>
            </form>
        </div>
    </div>
</div>
</div>

</html>
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
        $('.dynamic_function').change(function() {
            var invoice = $(this).val();
            var supplier_id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(invoice);
            $.ajax({
                url: `/purchasing/where/search`,
                method: "get",
                data: {
                    'invoice': invoice,
                },
                success: function(data) {
                    console.log(data);
                    op += '<input value="0" disabled>';
                    for (var i = 0; i < data.length; i++) {
                        var supplier_id = data[i].supplier_id;
                        console.log(supplier_id);
                        document.getElementById('supplier_id').value = supplier_id;

                    };
                },
                error: function() {}
            })
        })
    })
</script>
@stop