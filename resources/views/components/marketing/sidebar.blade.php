<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="{{ (request()->is('marketing/pricelist*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.pricelist.index') }}"><i class="fa fa-wheelchair"></i> <span>Order</span></a>
    </li>
    <li class="{{ (request()->is('marketing/doctor*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.doctor.index') }}"><i class="fa fa-user-md"></i> <span>Stok</span></a>
    </li>
    <li class="{{ (request()->is('marketing/patient*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.patient.index') }}"><i class="fa fa-wheelchair"></i> <span>Reinburst</span></a>
    </li>
    <li class="{{ (request()->is('marketing/appointments*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.appointments.index') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
    </li>
</ul>