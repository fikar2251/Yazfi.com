@extends('layouts.master', ['title' => 'Dashboard'])

@section('content')
    {{-- <div class="row">
    @foreach ($data as $product)
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama_project }}</h5>
                <p class="card-text">{{ $product->alamat_project }}.</p>
                <div class="account-logo1">
                    <img src="{{url('/img/logo/rumah1.jpg')}}" alt="Image" />
                </div>

                <a href="{{route('marketing.pricelist.show', $product->id)}}" class="btn btn-primary">Booking</a>


            </div>
        </div>
    </div>
    @endforeach
</div> --}}
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Sales</h4>
        </div>
    </div>

     <div class="row doctor-grid">
            @foreach($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src="" style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a href="{{url('supervisor/payment/'. $u->id)}}">{{$u->name}}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{$u->address}}
                    </div>
                </div>
            </div>
            @endforeach
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
