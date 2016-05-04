<div id="sidebar">
    <div class="sidebar-scroll">
        <div class="sidebar-content">
            <a href="/" class="sidebar-brand">
                <strong>PDH Shop</strong>
            </a>
            <ul class="sidebar-nav">
                <li class="{{active_class('users.index*')}}">
                    <a href="{{route('admin.users.index')}}">
                        <i class="sidebar-nav-icon"></i>Users
                    </a>
                </li>
                <li class="{{active_class('categories.index*')}}">
                    <a href="{{route('admin.categories.index')}}">
                        <i class="sidebar-nav-icon"></i>Categories
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>