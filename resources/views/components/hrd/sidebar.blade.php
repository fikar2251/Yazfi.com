<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="{{ request()->is('hrd/users*') ? 'active' : '' }}">
        <a href="{{ route('hrd.users.index') }}"><i class="fa fa-users"></i> <span>Master User</span></a>
    </li>
    <li class="{{ request()->is('hrd/roles*') ? 'active' : '' }}"> <a href="{{ route('hrd.roles.index') }}"><i class="fa fa-user"></i><span>Master Roles</span></a></li>
    <li class="submenu">
        <a href="#"><i class="fa fa-flag-o"></i> <span> Master Penggajuan & Reports </span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ route('admin.report.appoinment') }}"> Laporan Appointment </a></li>
            <li><a href="{{ route('admin.report.payment') }}"> Laporan Metode Pembayaran </a></li>
            <li><a href="{{ route('admin.report.komisi') }}"> Laporan Komisi </a></li>
            <li><a href="{{ route('admin.report.pasien') }}"> Laporan Pasien </a></li>
            <li><a href="{{ route('admin.report.perpindahan.pasien')  }}"> Laporan Perpindahan Pasien </a></li>
            <li><a href="{{ route('admin.report.barang')  }}"> Laporan Barang</a></li>
        </ul>
    </li>
    <li class="{{ request()->is('admin/cabang*') ? 'active' : '' }}">
        <a href="{{ route('admin.cabang.index') }}"><i class="fa fa-building"></i> <span>Master Divisi</span></a>
    </li>
    <li class="{{ request()->is('hrd/jabatan*') ? 'active' : '' }}">
        <a href="{{ route('hrd.jabatan.index') }}"><i class="fa fa-calculator"></i> <span>Master Jabatan</span></a>
    </li>

    <li class="submenu">
        <a href="#"><i class="fa fa-user"></i> <span> Pengajuan Dana </span> <span class="menu-arrow"></span></a>
    </li>
    <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
        <a href="{{ route('admin.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Absensi</span></a>
    </li>
</ul>