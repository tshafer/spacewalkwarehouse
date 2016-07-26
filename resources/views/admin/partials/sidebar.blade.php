<div id="sidebar">
    <div class="sidebar-scroll">
        <div class="sidebar-content">
            <a href="/" class="sidebar-brand">
                <strong>SpaceWalk Admin</strong>
            </a>
            <ul class="sidebar-nav">

                <li class="{{active_class('admin/categories*')}}">
                    <a href="{{route('admin.categories.index')}}">
                        <i class="sidebar-nav-icon"></i>Categories
                    </a>
                </li>

                <li class="{{active_class('admin/products*')}}">
                    <a href="{{route('admin.products.index')}}">
                        <i class="sidebar-nav-icon"></i>Products
                    </a>
                </li>

                <li class="{{active_class('admin/units*')}}">
                    <a href="{{route('admin.units.index')}}">
                        <i class="sidebar-nav-icon"></i>Units
                    </a>
                </li>

                <li class="{{active_class('admin/users*')}}">
                    <a href="{{route('admin.users.index')}}">
                        <i class="sidebar-nav-icon"></i>Users
                    </a>
                </li>
                <li>
                    <a href="{{route('auth.logout')}}">
                        <i class="sidebar-nav-icon"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>