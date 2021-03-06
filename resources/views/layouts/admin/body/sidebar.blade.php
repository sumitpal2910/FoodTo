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
                <li
                    class="nav-item {{$prefix ===('admin/state' ||'admin/district' || 'admin/city') ? 'menu-open' :''}}">
                    <a href="#"
                        class="nav-link  {{$prefix === ('admin/state' ||'admin/district' || 'admin/city') ? 'active' :''}}">
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

                <!-- Restaurant -->
                <li class="nav-item {{$prefix === 'admin/restaurant' ? 'menu-open' :''}}">
                    <a href="#" class="nav-link  {{$prefix === 'admin/restaurant' ? 'active' :''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Restaurants <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--Add Restaurant  -->
                        {{--<li class="nav-item">
                            <a href="{{route('admin.restaurant.create')}}"
                        class="nav-link {{$route === 'admin.restaurant.create' ? 'active' :''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Restaurant</p>
                        </a>
                </li>--}}

                <!-- Restaurant list -->
                <li class="nav-item">
                    <a href="{{route('admin.restaurant.index')}}"
                        class="nav-link {{$route === 'admin.restaurant.index' ? 'active' :''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Restaurant</p>
                    </a>
                </li>


            </ul>
            </li>

            <!-- Rider -->
            <li class="nav-item">
                <a href="{{route('admin.rider.index')}}"
                    class="nav-link {{ $route === 'admin.rider.index' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Riders</p>
                </a>
            </li>

            <!-- Payment -->
            <li class="nav-item {{$prefix === 'admin/bank' ? 'menu-open' :''}}">
                <a href="#" class="nav-link  {{$prefix === 'admin/bank' ? 'active' :''}}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p> Payments <i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <!-- Bank list -->
                    <li class="nav-item">
                        <a href="{{route('admin.bank.index')}}"
                            class="nav-link {{$route === 'admin.bank.index' ? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bank</p>
                        </a>
                    </li>


                </ul>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
