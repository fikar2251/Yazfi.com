@extends('layouts.master', ['title' => 'Holidays'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-sm-4 col-4">
        <h4 class="page-title">Holidays</h4>
    </div>

    <div class="col-sm-8 text-right m-b-20">
        @can('cabang-create')
        <a href="javascript:void(0)" class="btn btn btn-primary btn-rounded float-right" id="tombol-tambah"><i class="fa fa-plus"></i> Add Holiday</a>
        @endcan
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="table-holidays" class="table table-striped table-bordered custom-table mb-0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Holiday Date</th>
                                <th>Day</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">WARNING!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Delete Data Holidays</b></p>
                <p>The data will be deleted and will not be returned.</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label>Holiday Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" type="text">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Holiday Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control @error('title') is-invalid @enderror datetimepicker" id="holiday_date" name="holiday_date" type="text">
                                    @error('holiday_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">Simpan
                                </button>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
<script>
    var table;
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).ready(function() {
        table = $('#table-holidays').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('admin.holidays.index') }}`,
                type: 'get'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'holiday_date',
                    name: 'holiday_date'
                },
                {
                    data: 'day',
                    name: 'day'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            order: [
                [0, 'asc']
            ]
        });
    });
    $('#tombol-tambah').click(function() {
        $('#button-simpan').val("create-post");
        $('#id').val('');
        $('#form-tambah-edit').trigger("reset");
        $('#modal-judul').html("Tambah Holidays Baru");
        $('#tambah-edit-modal').modal('show');
    });
    $('body').on('click', '.edit-post', function() {
        var data_id = $(this).data('id');
        $.get('/admin/holidays/' + data_id + '/edit', function(data) {
            $('#modal-judul').html("Edit Post");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');
            $('#id').val(data.id);
            $('#title').val(data.title);
            $('#holiday_date').val(data.holiday_date);
        })
    });
    $(document).on('click', '.delete', function() {
        dataId = $(this).attr('id');
        $('#konfirmasi-modal').modal('show');
    });

    if ($("#form-tambah-edit").length > 0) {
        $("#form-tambah-edit").validate({
            submitHandler: function(form) {
                var actionType = $('#tombol-simpan').val();
                $('#tombol-simpan').html('Sending..');
                $.ajax({
                    data: $('#form-tambah-edit')
                        .serialize(),
                    url: "{{ route('admin.holidays.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Simpan');
                        $('#table-holidays').dataTable().fnDraw(false);
                        iziToast.success({
                            title: 'Data Berhasil Disimpan',
                            message: `{{ Session('success')}}`,
                            position: 'bottomRight'
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#tombol-simpan').html('Simpan');
                    }
                });
            }
        })
    }
    $('#tombol-hapus').click(function() {
        $.ajax({
            url: "/admin/holidays/" + dataId,
            type: 'delete',
            beforeSend: function() {
                $('#tombol-hapus').text('Hapus Data');
            },
            success: function(data) {
                setTimeout(function() {
                    $('#konfirmasi-modal').modal('hide');
                    $('#table-holidays').dataTable().fnDraw(false);
                });
                iziToast.warning({
                    title: 'Data Berhasil Dihapus',
                    message: `{{ Session('delete')}}`,
                    position: 'bottomRight'
                });
            }
        })
    });
</script>
@stop