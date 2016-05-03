<div id="sidebar">
    <div class="sidebar-scroll">
        <div class="sidebar-content">
            <a href="/" class="sidebar-brand">
                <strong>Washingtonian</strong>
            </a>

            <ul class="sidebar-nav">

                <li class="{{active_class('asktheexperts.index*')}}">
                    <a href="{{route('admin.asktheexperts.index')}}">
                        <i class="sidebar-nav-icon"></i>Ask The Experts
                    </a>
                </li>

                <li class="{{active_class('fitfests.index*')}}">
                    <a href="{{route('admin.fitfests.index')}}">
                        <i class="sidebar-nav-icon"></i>Fitfest
                    </a>
                </li>
                <li class="{{active_class('fitclasses.index*')}}">
                    <a href="{{route('admin.fitclasses.index')}}">
                        <i class="sidebar-nav-icon"></i>Classes
                    </a>
                </li>
                <li class="{{active_class('users.index*')}}">
                    <a href="{{route('admin.users.index')}}">
                        <i class="sidebar-nav-icon"></i>Users
                    </a>
                </li>
                {{--<li class="{{active_class('reports.index*')}}">--}}
                {{--<a href="{{route('admin.reports.index')}}">--}}
                {{--<i class="gi gi-user sidebar-nav-icon"></i>Reports--}}
                {{--</a>--}}
                {{--</li>--}}
                <li style="padding-left: 20px;font-weight: bold;">Ticketing</li>

                <li class="{{active_class('tickettypes.index*')}}">
                    <a href="{{route('admin.tickettypes.index')}}">
                        <i class="sidebar-nav-icon"></i>Ticket Types
                    </a>
                </li>

                <li class="{{active_class('events.index*')}}">
                    <a href="{{route('admin.events.index')}}">
                        <i class="sidebar-nav-icon"></i>Events
                    </a>
                </li>

                <li class="{{active_class('attendees.index*')}}">
                    <a href="{{route('admin.attendees.index')}}">
                        <i class="sidebar-nav-icon"></i>Attendees
                    </a>
                </li>
                <li class="{{active_class('coupons.index*')}}">
                    <a href="{{route('admin.coupons.index')}}">
                        <i class="sidebar-nav-icon"></i>Coupons
                    </a>
                </li>

                <li class="">
                    <a href="{{route('auth.logout')}}">
                        <i class="sidebar-nav-icon"></i>Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>