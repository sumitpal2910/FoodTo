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
                <a href="#" class="d-block">{{Auth::guard('rider')->user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{route('rider.dashboard')}}"
                        class="nav-link {{ $route === 'rider.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- Setting -->
                <li class="nav-item {{$prefix === 'rider/setting' ? 'menu-open' :''}}">
                    <a href="#" class="nav-link  {{$prefix === 'rider/setting' ? 'active' :''}}">
                        <i class="fas fa-cog"></i>
                        <p> Setting <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- State -->
                        <li class="nav-item">
                            <a href="{{route('rider.profile.index')}}"
                                class="nav-link {{$route === 'rider.profile.index' ? 'active' :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                    </ul>
                </li>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
