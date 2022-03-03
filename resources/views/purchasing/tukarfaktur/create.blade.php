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
                    <form action="" name="autocomplete-textbox" id="autocomplete-textbox" method="get">

                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_po">No Purchasing Order <span
                                                    style="color: red">*</span></label>

                                             {{-- <select id="invoice" name="invoice" data-dependent="barang_id"
                                                class="form-control dynamic_function">
                                                @if (!request()->get('invoice'))
                                                <option selected value="Select Nomor PO"></option>
                                                @endif
                                                @foreach ($purchase as $item)
                                                @if (request()->get('invoice') == $item->invoice)
                                                <option value="{{ $item->invoice }}" selected>{{ $item->invoice }}
                                            </option>
                                            @else
                                            <option value="{{ $item->invoice }}">{{ $item->invoice }}</option>
                                            @endif
                                            @endforeach
                                            </select>  --}}
                                            <input type="text" id="invoice" name="invoice" data-dependent="barang_id"
                                                class="form-control dynamic_function">

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
                    @foreach ($purchase as $item)
                    @endforeach
                    
                 
                    @if (request()->get('invoice') == $item->invoice)
                    <form action="{{ route('purchasing.tukarfaktur.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
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
                                            <label for="no_faktur">No Faktur <span style="color: red">*</span></label>
                                            <input type="text" name="no_faktur" value="{{ $nourutTF }}" id="invoice"
                                                class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_faktur">Nilai Invoice <span
                                                    style="color: red">*</span></label>
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
                                            <label for="invoice">NO Invoice <span style="color: red">*</span></label>
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
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th style="text-align:center;"class=" text-light">No.</th>
                                            <th style="text-align:center;"class="text-light">Kelengkapan Dokumen</th>
                                            <th  style="width:10px; text-align:center;" class="text-light">Ada</th>
                                            <th style="width:80px;text-align:center;" class="text-light">Tidak Ada</th>
                                            <th style="text-align:center;" class="text-light"> Catatan</th>
                                        </tr>   
                                        <tbody>
                                            @foreach($purchasing as $barang)
                                            <tr style="font-size:12px;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <input type="text" value="{{$barang->nama_dokumen}}"
                                                        name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                                        class="form-control id_dokumen-{{ $loop->iteration }}"
                                                        placeholder="Nama Dokumen" disabled style="font-size:13px;">
    
                                                        @error('id_dokumen')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                </td>
                                                <td>
                                                    <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                                    class="form-control pilihan-{{ $loop->iteration }}"
                                                    data="{{ $loop->iteration }}" required="" id="pilihan"
                                                    value="Y" data-binding-checked="" style=" width:1.2em; text-align:center;";
                                                    >

                                                    @error('pilihan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                              
                                                </td>
                                                <td>
                                                    <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                                    class="form-control pilihan-{{ $loop->iteration }}"
                                                    data="{{ $loop->iteration }}" required="" id="pilihan"
                                                    value="T" data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                                    @error('pilihan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text"  name="keterangan[{{ $loop->iteration }}]" id="keterangan" required=""
                                                    class="form-control keterangan-{{ $loop->iteration }}"
                                                    placeholder="Keterangan"  style="font-size:13px;">
                                                    
                                                    @error('keterangan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
            
                    <br>
                    @elseif ($item->invoice <= request()->get('invoice'))
                    <form action="{{ route('purchasing.tukarfaktur.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="invoice">Number PO <span style="color: red">*</span></label>
                                            <input type="text" name="invoice" value="{{$nourutPO}}" id="invoice"
                                                class="form-control" readonly>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="nama">Nama <span style="color: red">*</span></label>
                                            <input type="text" value="{{auth()->user()->name}}" readonly
                                                class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="supplier">Supplier <span style="color: red">*</span></label>
                                            <select name="supplier_id" id="supplier" class="form-control select2">
                                                <option disabled selected>-- Select Supplier --</option>
                                                @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="cabang">Project <span style="color: red">*</span></label>
                                            <select name="project_id" id="nama_project"
                                                class="form-control input-lg dynamic" data-dependent="alamat_project"
                                                required="">
                                                <option disabled selected>-- Select Project --</option>
                                                @foreach($project as $projects)
                                                <option value="{{ $projects->id }}">{{ $projects->nama_project }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="invoice">Lokasi <span style="color: red">*</span></label>
                                            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
                                            <input type="datetime-local" name="tanggal" id="tanggal"
                                                class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="row">
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
                                            <input type="text" name="no_faktur" value="" id="invoice"
                                                class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_faktur">Nilai Invoice <span
                                                    style="color: red">*</span></label>
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
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th style="text-align:center;"class=" text-light">No.</th>
                                            <th style="text-align:center;"class="text-light">Kelengkapan Dokumen</th>
                                            <th  style="width:10px; text-align:center;" class="text-light">Ada</th>
                                            <th style="width:60px;text-align:center;" class="text-light">Tidak Ada</th>
                                            <th style="text-align:center;" class="text-light"> Catatan</th>
                                        </tr>   
                                        <tbody>
                                            @foreach($purchasing as $barang)
                                            <tr style="font-size:12px;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <input type="text" value="{{$barang->nama_dokumen}}"
                                                        name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                                        class="form-control id_dokumen-{{ $loop->iteration }}"
                                                        placeholder="Nama Dokumen" disabled style="font-size:13px;">
    
                                                        @error('id_dokumen')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                </td>
                                                <td>
                                                    <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                                    class="form-control pilihan-{{ $loop->iteration }}"
                                                    data="{{ $loop->iteration }}" required="" id="pilihan"
                                                    value="Y" data-binding-checked="" style=" width:1.2em; text-align:center;">

                                                    @error('pilihan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                              
                                                </td>
                                                <td>
                                                    <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                                    class="form-control pilihan-{{ $loop->iteration }} text-center"
                                                    data="{{ $loop->iteration }}" required="" id="pilihan"
                                                    value="T" data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                                    @error('pilihan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text"  name="keterangan[{{ $loop->iteration }}]" id="keterangan" required=""
                                                    class="form-control keterangan-{{ $loop->iteration }}"
                                                    placeholder="Keterangan"  style="font-size:13px;">
                                                    
                                                    @error('keterangan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add" class="btn btn-primary mb-2">Tambah Row Baru</button>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover border" id="table-show">
                                        <tr class="bg-success">
                                            <th class="text-light" style="width: 30%;">Nama Barang</th>
                                            <th class="text-light" style="width: 10%;">QTY</th>
                                            <th class="text-light" style="width: 10%;">UNIT</th>
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
                        <p class="text-info">*Mohon Untuk Input Dengan Benar dan Berurut : <span
                                class="badge badge-primary" id="counter"></span></p>
                        <div class="row invoice-payment">
                            <div class="col-sm-4 offset-sm-8">
                                <h6>Total due</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" id="sub_total" value="" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Include PPN</label>
                                        <div class="input-group">
                                            <input type="type" id="PPN" onchange="HowAboutIt()" class="form-control"  aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" id="tax" name="PPN" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Grand Total</label>
                                            <input type="text" id="grandtotal" name="grandtotal" readonly
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 offset-sm-8">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                    @else
                    @endif
                    {{-- @else
                    data kosong
                    @endif --}}
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
                            <input type="text" name="unit[${index}]" class="form-control unit-${index}" placeholder="Unit">
                        </td>
                        <td>
                            <input type="text" id="rupiah" name="harga_beli[${index}]" class="form-control harga_beli-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this), HowAboutIt(this)">
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
    
        var rupiah = document.getElementById('rupiah');
        if (rupiah) {
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            });
        }
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
    
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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
            var alamat = "";
            var lokasi = "";
            $.ajax({
                url: `/logistik/where/project`,
                method: "get",
                data: {
                    'id': id


                },
                success: function(data) {
                    console.log(data);
                    op += '<input value="0" disabled>';
                    for (var i = 0; i < data.length; i++) {
                        var alamat = data[i].alamat_project;
                        document.getElementById('lokasi').value = alamat;
                    };
                },
                error: function() {

                }
            })
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
</script>
@stop
