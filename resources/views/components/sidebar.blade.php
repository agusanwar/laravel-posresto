<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">NARVE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-house"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('dashboard-general-dashboard') }}">Dashboard</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Menu</li>
                <li>
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i>Users</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box-archive"></i>Products</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-cart-shopping"></i>Categopries</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('reports.index') }}"><i class="fas fa-clipboard"></i>All Reports</a>
                </li>
        </ul>
    </aside>
</div>
