<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    
    <li class="submenu">
        <a href="#"><i class="fa fa-users"></i> <span> Master</span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li class="{{ request()->is('hrd/users*') ? 'active' : '' }}">
                <a href="{{ route('hrd.users.index') }}"><span>User</span></a>
            </li>
            <li class="{{ request()->is('hrd/permission*') ? 'active' : '' }}"> 
                <a href="{{ route('hrd.permission.index') }}">
                <span>Roles</span></a></li>
            <li class="{{ request()->is('hrd/jabatan*') ? 'active' : '' }}">
                <a href="{{ route('hrd.jabatan.index') }}"><span>Jabatan</span></a>
            </li>
            <li class="{{ request()->is('hrd/roles*') ? 'active' : '' }}"> <a href="{{ route('hrd.roles.index') }}">
            <span>Divisi</span></a></li>
            {{-- <li><a href="{{ route('admin.report.barang')  }}"> Laporan Barang</a></li> --}}
        </ul>
    </li>
   
    <li class="{{ request()->is('hrd/reinburst*') ? 'active' : '' }}">
        <a href="{{ route('hrd.reinburst.index') }}"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Reinburst</span></a>
    </li>
    <li class="{{ request()->is('hrd/tim-sales*') ? 'active' : '' }}">
        <a href="{{ route('hrd.tim-sales.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Team Sales</span></a>
    </li>
  
    <li class="{{ request()->is('hrd/penerimaan*') ? 'active' : '' }}">
        <a href="{{ route('hrd.penerimaan.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Acc Reinburst</span></a>
    </li>
    <li class="{{ request()->is('hrd/pengajuan*') ? 'active' : '' }}">
        <a href="{{ route('logistik.pengajuan.index') }}"><i class="fa-solid fa-file-invoice"></i><span>Pengajuan dana</span></a>
    </li>

    <li class="{{ request()->is('hrd/attendance*') ? 'active' : '' }}">
        <a href="{{ route('hrd.attendance.index') }}"><i class="fa-solid fa-calendar-check"></i><span>Attandance</span></a>
    </li>
    <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
        <a href="{{ route('admin.purchase.index') }}"><i class="fa fa-money" aria-hidden="true"></i> <span>Payroll</span></a>
    </li>
</ul>