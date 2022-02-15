<div class="row">
    <div class="col-md-12">
        <div class="dash-widget shadow">
            <div class="dash-widget-info pb-4">
                <h2>Project List</h2>
            </div>
            <!-- <form action="{{ route('marketing.service.appointments.filter') }}" method="get">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Cabang</label>
                            <select class="select floating">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">From</label>
                            <div class="cal-icon">
                                <input id="startdate" name="startdate" class="form-control @error('startdate') is-invalid @enderror floating datetimepicker" type="text">
                                @error('startdate')
                                <strong class="invalid-feedback">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">To</label>
                            <div class="cal-icon">
                                <input id="enddate" name="enddate" class="form-control @error('enddate') is-invalid @enderror floating datetimepicker" type="text">
                                @error('enddate')
                                <strong class="invalid-feedback">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <button type="submit" class="btn btn-success btn-block"> Cari Jadwal </button>
                    </div>
                </div>
            </form> -->
        </div>
    </div>
</div>
@if($message = Session::get('success'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>
                {{ $message }}
            </strong>
        </div>
    </div>
</div>
@endif
@if($message = Session::get('error'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>
                {{ $message }}
            </strong>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>nama project</th>
                        <th>alamat</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $projects)
                    <tr>
                        <td>{{ $loop->iteration }}</td{>
                        <td>{ $projects->nama_project }}</a></td>
                        <td>{{ $projects->alamat_project}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@include('marketing.modal')
@section('footer')
<script>
    $(document).ready(function() {
        $('#startdate,#enddate').datetimepicker({
            useCurrent: true,
            minDate: moment()
        });
        $.ajax({
            url: '/marketing/cabang',
            success: function(data) {
                let name = $.each(data.resource, function() {
                    $('.select').append(`<option value="${this.id}">${this.nama}</option>`)
                });
            }
        })
    })
    $('.button-show-now').click(function() {
        status = $(this).attr('message')
        var button = $(this).attr('id')
        var dokter = $(this).attr('title')
        $('#pasien_id').html('')

        $.ajax({
            url: `/marketing/jadwal/now/${button}/${dokter}`,
            success: (data) => {
                console.log(data)
                $('#jadwal_id').val(button)
                $('#dokter_id').val(`${data.dokter.id}`)
                $('#waktu_mulai').val(data.booking)
                $('#dokter_name').val(data.dokter.name)

            }
        })
    })
    $('.button-show').click(function() {
        status = $(this).attr('message')
        var button = $(this).attr('id')
        var dokter = $(this).attr('title')
        $('#pasien_id').html('')
        $.ajax({
            url: `/marketing/jadwal/${button}/${dokter}`,
            success: (data) => {
                console.log(data)
                $('#jadwal_id').val(button)


                $('#dokter_id').val(`${data.dokter.id}`)
                $('#waktu_mulai').val(data.booking)
                $('#dokter_name').val(data.dokter.name)

            }
        })
    })
    $('.pasienList').select2({
        placeholder: 'Select Customer',
        ajax: {
            url: `/marketing/where/customer`,
            processResults: function(data) {
                console.log(data)
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>
@endsection