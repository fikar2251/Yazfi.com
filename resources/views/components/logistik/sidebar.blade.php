<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li><a class="{{ (request()->is('logistik/product*')) ? 'active' : '' }}" href="{{ route('logistik.product.index') }}">Barang</a></li>
    <li class="{{ request()->is('logistik/purchase*') ? 'active' : '' }}">
        <a href="{{ route('logistik.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Order</span></a>
    </li>
    <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
        <a href="{{ route('admin.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Pengajuan Dana</span></a>
    </li>


    <!-- @can('report-access')
    <li class="submenu">
        <a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ route('admin.report.appoinment') }}"> Laporan Appointment </a></li>
            <li><a href="{{ route('admin.report.payment') }}"> Laporan Metode Pembayaran </a></li>
            <li><a href="{{ route('admin.report.komisi') }}"> Laporan Komisi </a></li>
            <li><a href="{{ route('admin.report.pasien') }}"> Laporan Pasien </a></li>
            <li><a href="{{ route('admin.report.perpindahan.pasien')  }}"> Laporan Perpindahan Pasien </a></li>
            <li><a href="{{ route('admin.report.barang')  }}"> Laporan Barang</a></li>
        </ul>
    </li>
    @endcan
   -->
</ul>