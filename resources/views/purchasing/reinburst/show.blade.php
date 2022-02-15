@extends('layouts.master', ['title' => 'Create Purchase'])

@section('content')
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="row">
        <div class="col-sm-5 col-4">
            <h4 class="page-title">Order</h4>
        </div>
        <div class="col-sm-7 col-8 text-right m-b-30">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-white">CSV</button>
                <button class="btn btn-white">PDF</button>
                <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header p-4">
            <img src="{{url('/img/logo/yazfi.png')}}" class=" inv-logo" alt="">
            <div class="float-right">
                <h6><strong>Fomulir:</strong></h6>
                <input type="checkbox" id="c1" name="cc" />
                <label style="font-size:.80em;">Material Delivered</label>
            </div>
            <div class="col-sm-8 col-7 text-right m-b-15">
                <h3><span class="purchase-order">Purchase Order</span></h3>

            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <tr>
                        <td width="150px">Supplier/ Vendor</td>
                        <td> : </td>
                        <td>{{ $purchase->supplier->nama }}</td>
                    </tr>
                    <tr>
                        <td width="150px">Contact Person</td>
                        <td> : </td>
                        <td>{{ $purchase->admin->name }}</td>
                    </tr>
                    <tr>
                        <td width="150px">Location</td>
                        <td> : </td>
                        <td>{{ $purchase->supplier->nama }}</td>
                    </tr>
                    <tr>
                        <td width="150px">Delevery On Site</td>
                        <td> : </td>
                        <td>{{ $purchase->project->nama_project }}</td>
                        <td>{{ $purchase->lokasi }}</td>
                    </tr>
                </div>
                <div class="col-sm-6 ">
                    <tr>
                        <td width="150px">DATE</td>
                        <td> : </td>
                        <td>{{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td width="150px">PO Number</td>
                        <td> : </td>
                        <td><b>{{ $purchase->invoice }}</b></td>
                    </tr>
                    <tr>
                        <td width="150px">Project</td>
                        <td> : </td>
                        <td>{{ $purchase->project->nama_project }}</td>
                    </tr>
                    <tr>
                        <td width="150px">Project</td>
                        <td> : </td>
                        <td>{{ $purchase->project->id }}</td>
                    </tr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover border" id="table-show">
                            <tr class="bg-success">
                                <th class="text-light">Acc.</th>
                                <th class="text-light">NO.</th>
                                <th class="text-light">Description</th>
                                <th class="text-light">Qty</th>
                                <th class="text-light">Unit</th>
                                <th class="text-light">Unit Price</th>
                                <th class="text-light">Total Price</th>
                            </tr>
                            <tbody>
                                @php
                                $total = 0
                                @endphp
                                @foreach(App\Purchase::where('invoice', $purchase->invoice)->get() as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->barang_id }}</td>
                                    <td>{{ $barang->barang->nama_barang }}</td>
                                    <td>{{ $barang->barang_id }}</td>
                                    <td>{{ $barang->qty }}</td>
                                    <td>@currency($barang->harga_beli)</td>
                                    <td>@currency($barang->total)</td>
                                </tr>
                                @php
                                $total += $barang->total
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-right">
                                    <td colspan="5">SUB TOTAL : </td>
                                    <td colspan="5">@currency($total)</td>

                                </tr>
                                <tr class="text-right">
                                    <td colspan="5">PPN 10%: </td>
                                    <td colspan="5">@currency($total * 0.1)</td>

                                </tr>
                                <tr class="text-right">
                                    <td colspan="5"><strong>TOTAL</strong> </td>
                                    <td colspan="5">@currency($total * 0.1 + $total)</td>

                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Note</strong> </td>
                                    <td colspan="3">PURCHASING </td>
                                    <td colspan="3">MANAGER PROCUREMENT </td>
                                </tr>

                                <tr class="text-right">
                                    <td colspan="6">DIRECTUR </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection