@extends('layouts.master', ['title' => 'Pengajian'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Penggajian</h1>
    </div>

    <div class="col-sm-8 text-right m-b-20">

        <a href="{{ route('hrd.gaji.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Penggajian</a>

    </div>
</div>

<x-alert></x-alert>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('hrd.gaji.filter') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control @error('start') is-invalid @enderror" name="start">
                                @error('start')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control @error('end') is-invalid @enderror" name="end">
                                @error('end')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success btn-block">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped custom-table report">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>Pegawai</th>
                                <th>Tanggal</th>
                                <th>Bulan&Tahun</th>
                                <th>Gaji pokok</th>
                                <th>Penerimaan</th>
                                <th>Potongan</th>
                                <th>Total</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                        $array_gaji_pokok = [];
                        $array_penerimaan = [];
                        $array_potongan = [];
                        $array_total = [];
                        @endphp
                        <tbody>
                            @foreach($penggajians as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->pegawai->name }}</td>
                                <td>{{ $data->tanggal }}</td>
    
                                    <td>{{ Carbon\Carbon::parse($data->bulan_tahun)->format("F/Y") }}</td>
                                <td>{{ number_format($data->gaji_pokok) }}</td>
                                <th>{{ number_format($data->penerimaan->sum('nominal') - $data->gaji_pokok) }}</th>
                                <th>{{ number_format($data->potongan->sum('nominal')) }}</th>
                                <th>{{ number_format($data->gaji_pokok + (($data->penerimaan->sum('nominal') - $data->gaji_pokok) - $data->potongan->sum('nominal'))) }}</th>
                                <td>{{ $data->jabatan }}</td>
                                <td>{{ $data->divisi }}</td>
                                <td>{{ $data->admin }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('hrd.gaji.print',$data->id) }}" class="btn btn-sm btn-secondary">print</a>
                                        <a href="{{ route('hrd.gaji.show',$data->id) }}" class="btn btn-sm btn-success">Rincian</a>
                                        <a href="{{ route('hrd.gaji.edit',$data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('hrd.gaji.destroy', $data->id) }}"class="delete-form" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger delete_confirm" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @php
                            array_push($array_gaji_pokok, $data->gaji_pokok);
                            array_push($array_penerimaan, $data->penerimaan->sum('nominal') - $data->gaji_pokok);
                            array_push($array_potongan, $data->potongan->sum('nominal'));
                            array_push($array_total, $data->gaji_pokok + (($data->penerimaan->sum('nominal') - $data->gaji_pokok) - $data->potongan->sum('nominal')));
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th>{{ number_format(array_sum($array_gaji_pokok)) }}</th>
                                <th>{{ number_format(array_sum($array_penerimaan)) }}</th>
                                <th>{{ number_format(array_sum($array_potongan)) }}</th>
                                <th >{{ number_format(array_sum($array_total)) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footer')
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

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
                title: 'Laporan Penggajian ',
                messageTop: 'Tanggal  {{ request("start") }} - {{ request("end") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Penggajian ',
                messageTop: 'Tanggal {{ request("start") }} - {{ request("end") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop