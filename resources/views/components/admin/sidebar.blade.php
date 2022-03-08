<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    @can('product-access')
    <li class="{{ request()->is('admin/pembatalans*') ? 'active' : '' }}">
        <a href="{{ route('admin.pembatalans.index') }}"><i class="fa fa-shopping-bag"></i> <span>Canceling</span></a>
    </li>
    @endcan
    @role('super-admin')
    <li class="submenu">
        <a href="#" class=""><i class="fa fa-cog"></i> <span> Master </span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
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
            <li class="{{ request()->is('admin/kategoribarang*') ? 'active' : '' }}">
                <a href="{{ route('admin.kategoribarang.index') }}"><i class="fa fa-shopping-bag"></i> <span>Kategori Barang</span></a>
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
            <li class="{{ request()->is('admin/customer*') ? 'active' : '' }}">
                <a href="{{ route('admin.customer.index') }}"><i class="fa fa-calculator"></i> <span>Customer</span></a>
            </li>
            @endcan
         
        </ul>
    </li>
    @endrole
   
</ul>