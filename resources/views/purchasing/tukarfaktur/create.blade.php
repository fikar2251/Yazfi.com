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

                <div class="row">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">

                                    <label for="no_po">Berdasarkan Pilihan : </label>


                                    <input style="width:15px;" id="radioButton" type="radio" name="pilihan[1]" value="1"
                                        {{old('pilihan.1') =="1" ? 'checked='.'"'.'checked'.'"' : ''}} class="detail"
                                        id="inlineCheckbox1">
                                    <label class="form-check-label" for="inlineCheckbox1">No Penerimaan Barang</label>
                                    <input style="width:15px;" id="radioButton" type="radio" name="pilihan[1]" value="2"
                                        {{old('pilihan.1') =="2" ? 'checked='.'"'.'checked'.'"' : ''}} class="detail"
                                        id="inlineCheckbox2">
                                    <label class="form-check-label" for="inlineCheckbox2">SPK</label>

                                </div>

                            </li>
                        </ul>
                    </div>

                </div>
                <div id="form-input">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_po">No Penerimaan Barang <span
                                                    style="color: red">*</span></label>

                                            <div class="input-group mb-3">
                                                <input type="text" name="no_penerimaan_barang" id="no_penerimaan_barang"
                                                    data-dependent="barang_id" class="form-control dynamic_function"
                                                    value="{{old('no_penerimaan_barang')}}">
                                                <button type="search" name="search" class="btn btn-primary"><i
                                                        class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>

                                        </div>


                                    </li>
                                </ul>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($purchase as $item)


@if (request()->get('no_penerimaan_barang') == $item->no_penerimaan_barang &&
$item->status_tukar_faktur == $item->status_tukar_faktur = 'pending' )
<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">
                <div id="form-input">
                    <form action="{{ route('purchasing.tukarfaktur.store') }}" name="form1" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="id_supplier">Nama Vendor <span
                                                    style="color: red">*</span></label>
                                            <input type="text" value="{{ $penerimaans->name }}" id="supplier_id"
                                                class="form-control">
                                            <input type="hidden" name="id_supplier"
                                                value="{{ $penerimaans->supplier_id }}" id="supplier_id"
                                                class="form-control">

                                            @error('id_supplier')
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
                                            <label for="no_faktur">Number Faktur <span
                                                    style="color: red">*</span></label>
                                            <input type="text" name="no_faktur" value="{{ $nourutTF }}" id="no_faktur"
                                                class="form-control">

                                            @error('no_faktur')
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
                                            <label for="no_po_vendor">Number PO Vendor <span
                                                    style="color: red">*</span></label>
                                            <input type="text" name="no_po_vendor" value="{{ $penerimaans->invoice}}"
                                                id="no_po_vendor" class="form-control">

                                            @error('no_po_vendor')
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
                                            <label for="nilai_invoice">Nilai Invoice <span
                                                    style="color: red">*</span></label>
                                            <input type="text" readonly required="" name="nilai_invoice" value="{{ $penerimaans->total }}"
                                                class="form-control">

                                            @error('nilai_invoice')
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
                                            <label for="tanggal_tukar_faktur">Tanggal Tukar Faktur <span
                                                    style="color: red">*</span></label>
                                            <input type="datetime-local" name="tanggal_tukar_faktur"
                                                id="tanggal_tukar_faktur" required="" class="form-control">

                                            @error('tanggal_tukar_faktur')
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
                                            <label for="no_invoice">Number Invoice <span
                                                    style="color: red">*</span></label>
                                            <input type="text" name="no_invoice" value="" id="no_invoice"
                                                class="form-control" required="">

                                            @error('no_invoice')
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

                                            <input type="hidden" name="id_project" id="id_project" class="form-control"
                                                value="{{ $penerimaans->project_id }}">

                                            @error('id_project')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">

                                            <input type="hidden" value="{{$penerimaans->status_pembayaran}}"
                                                name="status_pembayaran" id="status_pembayaran" required=""
                                                class="form-control">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <input type="hidden" name="po_spk" value="1" class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <table class="table table-bordered  report">
                            <tr style="font-size:12px;" class="bg-success">
                                <th style="text-align:center;" class=" text-light">No.</th>
                                <th style="text-align:center;" class="text-light">Kelengkapan
                                    Dokumen</th>
                                <th style="width:10px; text-align:center;" class="text-light">
                                    Ada</th>
                                <th style="width:80px;text-align:center;" class="text-light">
                                    Tidak Ada</th>
                                <th style="text-align:center;" class="text-light"> Catatan</th>
                            </tr>
                            <tbody>
                                @foreach($purchasing as $barang)
                                <tr style="font-size:12px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" value="{{$barang->nama_dokumen}}" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }} disabled"
                                            placeholder="Nama Dokumen" style="font-size:13px;">
                                        <input type="hidden" value="{{$barang->id}}"
                                            name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }}"
                                            placeholder="Nama Dokumen" style="font-size:13px;">

                                        @error('id_dokumen')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="Y"
                                            data-binding-checked="" style=" width:1.2em; text-align:center;" ;>

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="T"
                                            data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="catatan[{{ $loop->iteration }}]" id="catatan"
                                            class="form-control catatan-{{ $loop->iteration }}" placeholder="catatan"
                                            style="font-size:13px;">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow" id="card">
                                    <div class="table-responsive">
                                        <div class="col-md-12">

                                            <br>
                                            <br>
                                            <div class="col-sm-5 col-4">
                                                <h4 class="page-title">Riwayat Penerimaan Barang
                                                </h4>
                                            </div>
                                            <table class="table table-bordered  report">
                                                <tr style="font-size:12px;" class="bg-success">
                                                    <th class=" text-light">No.</th>
                                                    <th class="text-light">Nama Barang</th>
                                                    <th class="text-light">Qty</th>
                                                    <th class="text-light">Harga</th>
                                                    <th class="text-light"> Total</th>
                                                    <th class="text-light"> Diajukan</th>
                                                    <th class="text-light"> Status Barang</th>

                                                </tr>
                                                <tbody id="dynamic_field">
                                                    @foreach($purchases as $purchase)
                                                    <tr class="rowComponent">
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>

                                                        <td>
                                                            <input type="text" value="{{$purchase->nama_barang}}"
                                                                name="nama_barang[{{ $loop->iteration }}]"
                                                                id="nama_barang" required=""
                                                                class="form-control nama_barang-{{ $loop->iteration }}"
                                                                style="font-size:13px;">
                                                        </td>
                                                        <td>
                                                            {{$purchase->qty_received}}
                                                        </td>
                                                        <td>
                                                            @currency($purchase->harga_beli)
                                                        </td>
                                                        <td>
                                                            @currency($purchase->harga_beli *
                                                            $purchase->qty_received)
                                                        </td>
                                                        <td>
                                                            {{$purchase->name}}
                                                        </td>
                                                        <td>
                                                            {{$purchase->status_barang}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4"><b>Total Pembelian : </b>
                                                            
                                                        </td>
                                                        {{-- <td><b>{{ \App\PenerimaanBarang::where('qty_received',$purchase->qty_received)->sum('qty_received')}}</b>
                                                            </td> --}}
                                                        {{-- <td> {{$purchase->qty_received}}</td> --}}
                                                        {{-- <td> {{$purchase->qty_received}}</td> --}}
                                                        <td><b>@currency($purchase->total)</b></td>
                                                        <td></td>
                                                        <td></td>
                                               
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="form-group text-right">
                                                <div class="col-sm-12 col-sg-6 col-md-12 m-b-6">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="submit">Submit</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif ($item->no_penerimaan_barang <= request()->get('no_penerimaan_barang'))

    @else
    @endif
    @endforeach



    {{-- Form SPK --}}
    <div id="form-spk">
        <form action="{{ route('purchasing.tukarfaktur.store') }}" name="form2" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="no_po_vendor">Number PO <span style="color: red">*</span></label>
                                <input type="text" name="no_po_vendor" value="{{$nourutPO}}" id="no_po_vendor"
                                    class="form-control" readonly>


                                @error('no_po_vendor')
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
                                <label for="no_faktur">Number Tukar Faktur<span style="color: red">*</span></label>
                                <input type="text" name="no_faktur" value="{{$nourutTF}}" id="no_faktur"
                                    class="form-control" readonly>

                                @error('no_faktur')
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
                                <label for="id_supplier">Supplier <span style="color: red">*</span></label>
                                <select name="id_supplier" id="id_supplier" class="form-control select2">
                                    <option disabled selected>-- Select Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama }}
                                    </option>
                                    @endforeach

                                    @error('id_supplier')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="id_project">Project <span style="color: red">*</span></label>
                                <select name="id_project" id="id_project" class="form-control input-lg dynamic"
                                    data-dependent="alamat_project" required="">
                                    <option disabled selected>-- Select Project --</option>
                                    @foreach($project as $projects)
                                    <option value="{{ $projects->id }}">
                                        {{ $projects->nama_project }}
                                    </option>
                                    @endforeach

                                    @error('id_project')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                <input type="text" id="lokasi" class="form-control" readonly>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="tanggal_tukar_faktur">Tanggal<span style="color: red">*</span></label>
                                <input type="datetime-local" required="" name="tanggal_tukar_faktur" id="tanggal_tukar_faktur"
                                    class="form-control">

                                @error('tanggal_tukar_faktur')
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
                                <label for="no_invoice">No Invoice<span style="color: red">*</span></label>
                                <input type="text" required="" name="no_invoice" id="no_invoice" class="form-control">

                                @error('no_invoice')
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
                                <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
                                <input type="text" name="nama_barang" class="form-control">

                                @error('nama_barang')
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
                                <label for="nilai_invoice">Nilai Invoice <span style="color: red">*</span></label>
                                <input type="text" name="nilai_invoice" required=""class="form-control">

                                @error('nilai_invoice')
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

                                <input type="hidden" value="{{auth()->user()->id}}" name="id_user" id="id_user" readonly
                                    class="form-control">

                                @error('nama')
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
                                <input type="hidden" name="po_spk" value="2" class="form-control">
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
                                <th style="text-align:center;" class=" text-light">No.</th>
                                <th style="text-align:center;" class="text-light">Kelengkapan
                                    Dokumen
                                </th>
                                <th style="width:10px; text-align:center;" class="text-light">Ada
                                </th>
                                <th style="width:60px;text-align:center;" class="text-light">Tidak
                                    Ada
                                </th>
                                <th style="text-align:center;" class="text-light"> Catatan</th>
                            </tr>
                            <tbody>
                                @foreach($purchasing as $barang)
                                <tr style="font-size:12px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" value="{{$barang->nama_dokumen}}" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }} disabled"
                                            placeholder="Nama Dokumen" style="font-size:13px;">
                                        <input type="hidden" value="{{$barang->id}}"
                                            name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }}"
                                            placeholder="Nama Dokumen" style="font-size:13px;">

                                        @error('id_dokumen')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="Y"
                                            data-binding-checked="" style=" width:1.2em; text-align:center;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }} text-center"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="T"
                                            data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan[{{ $loop->iteration }}]" id="keterangan"
                                            class="form-control keterangan-{{ $loop->iteration }}" placeholder="Catatan"
                                            style="font-size:13px;">

                                        {{-- @error('keterangan')
                                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror --}}
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
            {{-- <p class="text-info">*Mohon Untuk Input Dengan Benar dan Berurut : <span class="badge badge-primary"
            id="counter"></span></p>
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
                        <input type="type" id="PPN" onchange="HowAboutIt()" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" id="tax" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Grand Total</label>
                        <input type="text" id="grandtotal" readonly class="form-control">
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="col-sm-12 col-sg-4 m-b-4">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>

    </div>

    </html>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function submit_form() {
            document.form1.submit();
            document.form2.submit();
        }

        $(document).ready(function () {
            $("#form-input").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
            $("#form-spk").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
            $(".detail").click(
                function () { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
                    if ($("input[name='pilihan[1]']:checked").val() ==
                        "1") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
                        $("#form-input").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
                    } else {
                        $("#form-input").slideUp("fast"); //Efek Slide Down (Menampilkan Form Input)
                        //Efek Slide Down (Menampilkan Form Input)
                    }
                    if ($("input[name='pilihan[1]']:checked").val() ==
                        "2") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
                        $("#form-spk").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
                    } else {
                        $("#form-spk").slideUp("fast"); //Efek Slide Down (Menampilkan Form Input)
                        //Efek Slide Down (Menampilkan Form Input)
                    }
                });
        });
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
                            // <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
                        </td>
                        <td>
                            <input type="text" name="nama_barang[${index}]"  class="form-control nama_barang-${index}" placeholder="Nama Barang">
                        </td>
                        <td>
                            <input type="number" name="qty[${index}]"  class="form-control qty-${index}" placeholder="0">
                        </td>
                        <td>
                            <select required name="unit[${index}]" id="${index}" class="form-control select-${index}"></select>
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
                placeholder: 'Select Unit',
                ajax: {
                    url: `/purchasing/where/unit`,
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
        var rupiah = document.getElementById('rupiah');
        if (rupiah) {
            rupiah.addEventListener('keyup', function (e) {
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
        $(document).ready(function () {
            $('#add').on('click', function () {
                form_dinamic()
            })
        })
        $(document).ready(function () {
            $('.dynamic').change(function () {
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
                    success: function (data) {
                        console.log(data);
                        op += '<input value="0" disabled>';
                        for (var i = 0; i < data.length; i++) {
                            var alamat = data[i].alamat_project;
                            document.getElementById('lokasi').value = alamat;
                        };
                    },
                    error: function () {}
                })
            })
        })
        $(document).ready(function () {
            $('.dynamic_function').change(function () {
                var no_penerimaan_barang = $(this).val();
                var id = $(this).val();
                var div = $(this).parent();
                var op = " ";
                console.log(no_penerimaan_barang);
                $.ajax({
                    url: `/purchasing/where/tukar/search`,
                    method: "get",
                    data: {
                        'id': id,
                        'no_penerimaan_barang': no_penerimaan_barang,
                    },
                    success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            var id = data[i].id;
                            // console.log(supplier_id);
                            document.getElementById('id').value = id;
                            var no_penerimaan_barang = data[i].no_penerimaan_barang;
                            // console.log(supplier_id);
                            document.getElementById('no_penerimaan_barang').value =
                                no_penerimaan_barang;
                        };
                    },
                    error: function () {}
                })
            })
        })

    </script>
    @stop
