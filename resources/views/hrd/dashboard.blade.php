<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $doctor }}</h3>
                <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $appointment }}</h3>
                <span class="widget-title3">Appointment Pending<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h4 class="p-1">{{ $tindakan }}</h4>
                <span class="widget-title4">Tindakan Pending<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>