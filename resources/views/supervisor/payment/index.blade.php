@extends('layouts.master', ['title' => 'Pembatalan'])

@section('content')
    <div class="text-center">
        <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">PEMBATALAN UNIT</h4>
    </div>
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Sales</h4>
        </div>
    </div>

    <div class="row doctor-grid">
        @foreach ($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src=""
                                style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a
                            href="{{ url('supervisor/cancel/' . $u->id) }}">{{ $u->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $u->address }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Pembatalan</h4>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="batal" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal pengajuan</th>
                                    <th>No pembatalan</th>
                                    <th>Type</th>
                                    <th>Spr</th>
                                    <th>Total beli</th>
                                    <th>Konsumen</th>
                                    <th>Sales</th>
                                    {{-- <th>Booking Fee</th>
                                    <th>DP</th> --}}
                                    <th>Diajukan</th>
                                    <th>Status</th>
                                    <th>Refund</th>
                                </tr>
                            </thead>
                            <tbody>
                               

                            </tbody>
                        </table>
                    </div>
                </div>
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
        $('#batal').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "/supervisor/payment/json",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',

                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'no_pembatalan',
                    name: 'no_pembatalan'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'no_transaksi',
                    name: 'no_transaksi',
                   
                },
                {
                    data: 'harga_net',
                    name: 'harga_net',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },
                {
                    data: 'konsumen',
                    name: 'konsumen'
                },
                {
                    data: 'sales',
                    name: 'sales'
                },
                {
                    data: 'diajukan',
                    name: 'diajukan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'refund',
                    name: 'refund',
                },
            ]
        });
    });
</script>
@stop