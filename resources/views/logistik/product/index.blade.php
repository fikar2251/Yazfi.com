@extends('layouts.master', ['title' => 'Product'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Product</h1>
    </div>
</div>
<x-alert></x-alert>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Project</th>
                        <th>Lokasi Barang</th>
                        <th>Qty</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('logistik.product.show', $product->id) }}">{{ $product->product->kode_barang }}</a></td>
                        <td>{{ $product->product->nama_barang }}</td>
                        <td>{{ $product->project->nama_project }}</td>
                        <td>{{ $product->lokasi_barang }}</td>
                        <td>{{ $product->qty }}</td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-default',
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop