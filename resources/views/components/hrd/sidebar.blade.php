<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="{{ (request()->is('hrd/appointments*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.appointments.index') }}"><i class="fa fa-table"></i> <span>Master User</span></a>
    </li>
    <li class="{{ (request()->is('hrd/roles*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.roles.index') }}"><i class="fa fa-table"></i> <span>Master Role</span></a>
    </li>

    <li class="{{ (request()->is('hrd/report*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.report.perpindahan.pasien') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Master Pengajian & Report</span></a>
    </li>
    <li class="{{ (request()->is('hrd/report*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.report.perpindahan.pasien') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Master Divisi</span></a>
    </li>
    <li class="{{ (request()->is('hrd/report*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.report.perpindahan.pasien') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Master Jabatan</span></a>
    </li>
    <li class="{{ (request()->is('hrd/report*')) ? 'active' : '' }}">
        <a href="{{ route('hrd.report.perpindahan.pasien') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Pengajuan Dana</span></a>
    </li>
</ul>