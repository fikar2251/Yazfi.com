<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    @can('purchase-access')
    <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
        <a href="{{ route('admin.purchase.index') }}"><i class="fa fa-calculator"></i> <span>Master Purchase</span></a>
    </li>
    @endcan
    @can('purchase-access')
    <li class="{{ request()->is('admin/transfer*') ? 'active' : '' }}">
        <a href="{{ route('admin.transfer.index') }}"><i class="fa fa-calculator"></i> <span>Transfer Stok</span></a>
    </li>
    @endcan
    <li><a class="{{ (request()->is('logistik/product*')) ? 'active' : '' }}" href="{{ route('logistik.product.index') }}">Barang</a></li>
    <li><a class="{{ (request()->is('logistik/purchase*')) ? 'active' : '' }}" href="{{ route('logistik.purchase.index') }}">Order</a></li>
    <li><a class="{{ (request()->is('logistik/purchase*')) ? 'active' : '' }}" href="{{ route('logistik.purchase.index') }}">Pengajuan Dana</a></li>
</ul>