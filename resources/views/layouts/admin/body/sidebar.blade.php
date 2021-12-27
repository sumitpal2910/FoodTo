@php
$prefix = Request::route()->getPrefix();
$route = Route::currentRouteName();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('storage/asset/logo/logo-short.png')}}" alt=""
            class="brand-image img-responsive img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FoodTo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                        class="nav-link {{ $route === 'admin.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Service Area -->
                <li class="nav-item {{$prefix === 'admin/service' ? 'menu-open' :''}}">
                    <a href="#" class="nav-link  {{$prefix === 'admin/service' ? 'active' :''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Service Area <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- State -->
                        <li class="nav-item">
                            <a href="{{route('admin.state.index')}}"
                                class="nav-link {{$route === 'admin.state.index' ? 'active' :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>State</p>
                            </a>
                        </li>

                        <!-- District -->
                        <li class="nav-item">
                            <a href="{{route('admin.district.index')}}"
                                class="nav-link {{$route === 'admin.district.index' ? 'active' :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>District</p>
                            </a>
                        </li>

                        <!-- City -->
                        <li class="nav-item">
                            <a href="{{route('admin.city.index')}}"
                                class="nav-link {{$route === 'admin.city.index' ? 'active' :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>City</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
