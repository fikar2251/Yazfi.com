@extends('layouts.master', ['title' => 'Komisi'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Komisi</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table" id="komisi" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Komisi</th>
                            <th>Tanggal Pengajuan</th>
                            <th>No SPR</th>
                            <th>Komisi Sales</th>
                            <th>Komisi SPV</th>
                            <th>Komisi Manager</th>
                            <th>Diajukan</th>
                            <th>Status</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($komisi as $km)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $km->no_komisi }}</td>
                                <td style="width: 100px">{{ $km->tanggal_komisi }}</td>
                                <td>{{ $km->no_spr }}</td>
                                <td>@currency($km->nominal_sales)</td>
                                <td style="width: 100px">@currency($km->nominal_spv)</td>
                                <td>@currency($km->nominal_manager)</td>
                                <td>{{ $km->spv }}</td>
                                <td>
                                    @if ($km->status_pembayaran == 'unpaid')
                                        <span class="custom-badge status-red">{{ $km->status_pembayaran }}</span>
                                    @elseif ($km->status_pembayaran == 'paid')
                                        <span class="custom-badge status-green">{{ $km->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td style="width: 80px">
                                    {{ $km->tanggal_pembayaran }}
                                </td>
                                
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
<script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script>
    $(function() {
        $('#komisi').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "/resepsionis/komisi/json",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',

                },
                {
                    data: 'no_komisi',
                    name: 'no_komisi',
                },
                {
                    data: 'tanggal_komisi',
                    name: 'tanggal_komisi',
                },
                {
                    data: 'no_spr',
                    name: 'no_spr',
                },
                {
                    data: 'nominal_sales',
                    name: 'nominal_sales',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },
                {
                    data: 'nominal_spv',
                    name: 'nominal_spv',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                   
                },
                {
                    data: 'nominal_manager',
                    name: 'nominal_manager',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },
                {
                    data: 'spv',
                    name: 'spv',
                },
                {
                    data: 'status_pembayaran',
                    name: 'status_pembayaran',
                },
                {
                    data: 'tanggal_pembayaran',
                    name: 'tanggal_pembayaran',
                },
            ]
        });
    });
</script>
@stop
