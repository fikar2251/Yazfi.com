<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    {{-- @can('dokter-access')
        <li class="{{ request()->is('resepsionis/dokter*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.dokter.index') }}"><i class="fa fa-user-md"></i> <span>Dokter</span></a>
        </li>
    @endcan
    @can('patient-access')
        <li class="{{ request()->is('resepsionis/pasien*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.pasien.index') }}"><i class="fa fa-wheelchair"></i> <span>Pasien</span></a>
        </li>
    @endcan
    @can('appointment-access')
        <li class="{{ request()->is('resepsionis/appointments*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.appointments.index') }}"><i class="fa fa-calendar"></i>
                <span>Appointments</span>
                <!-- <span class="badge badge-danger"></span> -->
            </a>
        </li>
    @endcan
    @can('appointment-access')
        <li class="{{ request()->is('resepsionis/report*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.report.payment') }}"><i class="fa fa-files-o"></i> <span>Report
                    Payment</span></a>
        </li>
    @endcan --}}

    <li class="{{ request()->is('resepsionis/payment') ? 'active' : '' }}">
        <a href="{{ route('resepsionis.payment') }}"><i class="fa-solid fa-money-bill-wave"></i> <span>Payment</span></a>
    </li>

    <li class="{{ request()->is('resepsionis/refund') ? 'active' : '' }}">
        <a href="{{ route('resepsionis.refund') }}"><i class="fa fa-files-o"></i> <span>Refund</span></a>
    </li>

    <li class="{{ request()->is('resepsionis/refund/list') ? 'active' : '' }}">
        <a href="{{ route('resepsionis.refund.list') }}"><i class="fa fa-files-o"></i> <span>List Refund</span></a>
    </li>

    <li class="{{ request()->is('resepsionis/komisi') ? 'active' : '' }}">
        <a href="{{ route('resepsionis.komisi') }}"><i class="fa fa-files-o"></i> <span>Komisi</span></a>
    </li>
</ul>
