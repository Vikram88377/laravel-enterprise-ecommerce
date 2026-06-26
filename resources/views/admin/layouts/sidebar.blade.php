<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light ml-3">
            Ecommerce Admin
        </span>
    </a>

    <div class="sidebar">

        <nav class="mt-3">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                       class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}"
                       class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                        class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.coupons.index') }}"
                        class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>Coupons</p>
                        </a>
                    </li>

                                                        <li class="nav-item">
                                        <a href="{{ route('admin.payments.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-credit-card"></i>
                                            <p>Payments</p>
                                        </a>
                                                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.reports.index') }}"
                            class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Reports</p>
                            </a>
                        </li>

                <li class="nav-item">
    <a href="{{ route('admin.audit-logs.index') }}"
       class="nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-history"></i>
        <p>Audit Logs</p>
    </a>
</li>

            </ul>

        </nav>

    </div>

</aside>