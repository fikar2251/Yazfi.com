<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    @can('product-access')
    <li class="{{ request()->is('admin/product*') ? 'active' : '' }}">
        <a href="{{ route('admin.product.index') }}"><i class="fa fa-shopping-bag"></i> <span>Barang</span></a>
    </li>
    @endcan
    @can('product-access')
    <li class="{{ request()->is('admin/unit*') ? 'active' : '' }}">
        <a href="{{ route('admin.unit.index') }}"><i class="fa fa-building"></i> <span>Unit</span></a>
    </li>
    @endcan
    @can('supplier-access')
    <li class="{{ request()->is('admin/supplier*') ? 'active' : '' }}">
        <a href="{{ route('admin.supplier.index') }}"><i class="fa fa-building"></i> <span>Vendor</span></a>
    </li>
    @endcan
    @can('product-access')
    <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
        <a href="{{ route('admin.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Customer</span></a>
    </li>
    @endcan

    
    @can('product-access')
    <li class="{{ request()->is('admin/product*') ? 'active' : '' }}">
        <a href="{{ route('admin.product.index') }}"><i class="fa fa-shopping-bag"></i> <span>Warehouse</span></a>
    </li>
    @endcan
    @can('product-access')
    <li class="{{ request()->is('admin/reinburst*') ? 'active' : '' }}">
        <a href="{{ route('admin.reinburst.index') }}"><i class="fa fa-shopping-bag"></i> <span>Reinburst</span></a>
    </li>
    @endcan
    @can('product-access')
    <li class="{{ request()->is('admin/pembatalans*') ? 'active' : '' }}">
        <a href="{{ route('admin.pembatalans.index') }}"><i class="fa fa-shopping-bag"></i> <span>Pembatalan Unit</span></a>
    </li>
    @endcan
    @can('product-access')
    <li class="{{ request()->is('admin/kategoribarang*') ? 'active' : '' }}">
        <a href="{{ route('admin.kategoribarang.index') }}"><i class="fa fa-shopping-bag"></i> <span>Kategori Barang</span></a>
    </li>
    @endcan

    {{-- @can('service-access')
    <li class="{{ request()->is('admin/service*') ? 'active' : '' }}">
        <a href="{{ route('admin.service.index') }}"><i class="fa fa-stethoscope"></i> <span>Master Service</span></a>
    </li>
    @endcan --}}
    {{-- @can('payment-access')
    <li class="{{ request()->is('admin/payments*') ? 'active' : '' }}">
        <a href="{{ route('admin.payments.index') }}"><i class="fa fa-credit-card"></i> <span>Master Payments</span></a>
    </li>
    @endcan --}}
    {{-- @can('status-access')
    <li class="{{ request()->is('admin/status*') ? 'active' : '' }}">
        <a href="{{ route('admin.status.index') }}"><i class="fa fa-line-chart"></i> <span>Master Status</span></a>
    </li>
    @endcan --}}
    {{-- @can('voucher-access')
    <li class="{{ request()->is('admin/voucher*') ? 'active' : '' }}">
        <a href="{{ route('admin.voucher.index') }}"><i class="fa fa-tags"></i> <span>Master Voucher</span></a>
    </li>
    @endcan --}}
    {{-- @can('komisi-access')
    <li class="{{ request()->is('admin/komisi*') ? 'active' : '' }}">
        <a href="{{ route('admin.komisi.index') }}"><i class="fa fa-money"></i> <span>Master Komisi</span></a>
    </li>
    @endcan --}}
    {{-- @can('simbol-access')
    <li class="{{ request()->is('admin/simbol*') ? 'active' : '' }}">
        <a href="{{ route('admin.simbol.index') }}"><i class="fa fa-question"></i> <span>Master Simbol</span></a>
    </li>
    @endcan --}}
    {{-- <li class="submenu">
        <a href="#"><i class="fa fa-user"></i> <span> Master Invoice </span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a class="{{ (request()->is('admin/holidays*')) ? 'active' : '' }}" href="{{ route('admin.holidays.index') }}">Holidays</a></li>
            <li><a class="{{ (request()->is('admin/attendance*')) ? 'active' : '' }}" href="{{ route('admin.attendance.index') }}">Attendance</a></li>
        </ul>
    </li> --}}
    {{-- @can('report-access')
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
    @endcan --}}
    @role('super-admin')
    <li class="submenu">
        <a href="#" class=""><i class="fa fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            @can('permission-access')
            <li class="{{ request()->is('admin/setting*') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}">Basic Setting</a></li>
            @endcan
            @can('permission-access')
            <li class="{{ request()->is('admin/permissions*') ? 'active' : '' }}"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
            @endcan
            @can('roles-access')
            <li class="{{ request()->is('admin/roles*') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
            @endcan
        </ul>
    </li>
    @endrole
</ul>