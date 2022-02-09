<ul>
    <li class="menu-title">Main</li>
    @can('appointment-access')
    <li class="{{ request()->is('supervisor/appointments*') ? 'active' : '' }}">
        <a href="{{ route('supervisor.appointments.index') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
    </li>
    @endcan
    @can('appointment-access')
    <li class="{{ request()->is('supervisor/komisi*') ? 'active' : '' }}">
        <a href="{{ route('supervisor.komisi.index') }}"><i class="fa fa-money"></i> <span>Komisi</span></a>
    </li>
    @endcan
</ul>