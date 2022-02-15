<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li class="{{ request()->is('logistik/product*') ? 'active' : '' }}">
        <a href="{{ route('logistik.product.index') }}"><i class="fa fa-calculator"></i> <span>Barang</span></a>
    </li>

    <li class="{{ request()->is('logistik/purchase*') ? 'active' : '' }}">
        <a href="{{ route('logistik.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Order</span></a>
    </li>
    <li class="{{ request()->is('logistik/pengajuan*') ? 'active' : '' }}">
        <a href="{{ route('logistik.pengajuan.index') }}"><i class="fa fa-calculator"></i> <span>Pengajuan dana</span></a>
    </li>

</ul>