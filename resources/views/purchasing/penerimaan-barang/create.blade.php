@extends('layouts.master', ['title' => 'Create Penerimaan Barang'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Penerimaan Barang</h4>
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
                                        <label for="no_po">No PO <span style="color: red">*</span></label>
                                        <input class="form-control dynamic_function" data-dependent="supplier_id"
                                            type="search" maxlength="15" minlength="15" id="invoice">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <select name="invoice" id="purchases" class="form-control">
                                            @if (!request()->get('invoice'))
                                                <option selected value=""></option>
                                            @endif
                                            @foreach ($purchases as $item)
                                                @if (request()->get('invoice') == $item->invoice)
                                                    <option value="{{ $item->invoice }}" selected>{{ $item->invoice }}</option>
                                                @else
                                                    <option value="{{ $item->invoice }}">{{ $item->invoice }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    
                                    <div class="col-sm-2">
                                        <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="supplier">Supplier <span style="color: red">*</span></label>
                                        <input type="text" id="supplier_id" class="form-control" readonly>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="project">Project <span style="color: red">*</span></label>
                                        <input type="text" id="project_id" class="form-control" readonly>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi <span style="color: red">*</span></label>
                                        <input type="text" id="lokasi" class="form-control" readonly>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal <span style="color: red">*</span></label>
                                        <input type="text" id="created_at" class="form-control" readonly>
                                    </div>
                                </li>
                            </ul>
                        </div>
                </form>
                <br>
                @if (request()->get($tukar))
                <form action="{{ route('purchasing.penerimaan-barang.store') }}" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered  report">
                                    <tr style="font-size:12px;" class="bg-success">
                                        <th class=" text-light">No.</th>
                                        <th class="text-light">Nama Barang</th>
                                        <th class="text-light">Qty Received</th>
                                        <th class="text-light">Qty Order</th>
                                        <th class="text-light">Harga Satuan</th>
                                        <th class="text-light"> Total</th>
                                        <th class="text-light"> Status Barang</th>
                                    </tr>
                                    <tbody>
                                        @foreach($purchases as $pur)
                                        <tr style="font-size:12px;">
                                            <td>{{$loop->iteration  }}</td>
                                            <td>
                                                <input type="text" id="barang_id" name="qty_received"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" onchange="testNum()" id="qty_received"
                                                    name="qty_received" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" id="qty" name="qty_received" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" id="harga_beli" name="qty_received"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" id="total" name="qty_received" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" id="status_barang" name="qty_received"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" name="submit" class="btn btn-primary submit-btn"><i
                                class="fa fa-save"></i>
                            Save</button>
                    </div>
                </form>
                @foreach($purchases as $item)
                @endforeach
                
         @if($item->id)
                <div class="row mt-5">
                    <div class="col-sm-12" style="text-align: left">
                        <h4 class="page-title">Riwayat Penerimaan</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered  report">
                                <thead>
                                    <tr>

                                        <th>NO</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>admin</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($purchases as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->harga_beli }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->admin->name }}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
         @endif
         @else

@endif
        </div>
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

    function hitung(e) {
        let harga = e.value
        let attr = $(e).attr('data')
        let qty = $(`.qty-${attr}`).val()
        let total = parseInt(harga * qty)

        $(`.total-${attr}`).val(total)

    }

    function TotalAbout(e) {
        let sub_total = document.getElementById('sub_total')
        let total = 0;
        let coll = document.querySelectorAll('.total-form')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        sub_total.value = total
        document.getElementById('grandtotal').value = total;
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
        let SUB = document.getElementById('sub_total').value;
        let PPN = document.getElementById('PPN').value;
        console.log(PPN);
        let tax = PPN / 100 * sub_total.value;
        console.log(tax);
        document.getElementById('tax').value = tax;
        console.log(SUB);
        let grand_total = parseInt(SUB) + parseInt(tax);
        document.getElementById('grandtotal').value = grand_total;
        console.log(grand_total);
    }

    $(document).ready(function () {
        $('#add').on('click', function () {
            form_dinamic()
        })
    })
    $(document).ready(function () {
        $('.dynamic_function').change(function () {
            var invoice = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(invoice);
            $.ajax({
                url: `/purchasing/where/penerimaan/search`,
                method: "get",
                data: {
                    'invoice': invoice,
                },
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        var supplier_id = data[i].supplier_id;
                        console.log(supplier_id);
                        document.getElementById('supplier_id').value = supplier_id;

                        var project_id = data[i].project_id;
                        console.log(project_id);
                        document.getElementById('project_id').value = project_id;

                        var lokasi = data[i].lokasi;
                        console.log(lokasi);
                        document.getElementById('lokasi').value = lokasi;

                        var created_at = data[i].created_at;
                        console.log(created_at);
                        document.getElementById('created_at').value = created_at;

                        var barang_id = data[i].barang_id;
                        console.log(barang_id);
                        document.getElementById('barang_id').value = barang_id;

                        var qty = data[i].qty;
                        console.log(qty);
                        document.getElementById('qty').value = qty;

                        var harga_beli = data[i].harga_beli;
                        console.log(harga_beli);
                        document.getElementById('harga_beli').value = harga_beli;

                        var total = data[i].total;
                        console.log(total);
                        document.getElementById('total').value = total;

                        var status_barang = data[i].status_barang;
                        console.log(status_barang);
                        document.getElementById('status_barang').value = status_barang;

                        var grand_total = data[i].grand_total;
                        console.log(grand_total);
                        document.getElementById('total').value = grand_total;

                    };
                },
                error: function () {}
            })
        })
    })

    function testNum(a) {
        let qty = document.getElementById('qty').value;
        let qty_received = document.getElementById('qty_received').value;
        if (qty > qty_received) {
            result = 'partial';

        } else {
            result = 'completed';
        }
        document.getElementById('status_barang').value = result;
    }

    function StatusBarang(e) {
        let status = document.getElementById('status_barang').value;
        let qty_received = document.getElementById('qty_received').value;
        if (status == qty_received) {

            let completed = completed;
            console.log(completed);
            document.getElementById('status_barang').value = completed;

        } else {

            let partial = completed;
            console.log(partial);
            document.getElementById('status_barang').value = partial;

        }

    }

</script>
@stop
