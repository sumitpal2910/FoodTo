@php
$user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}"><img alt="logo"
                src="{{Storage::url('asset/logo/logo-150px.png')}}"></a>

        <a href="#" class="nav-item" data-target="#mapModal" data-toggle="modal"> <span id="header-full-address">
                @if (Session::exists('user-address'))
                @php
                $address = Session::get('user-address');
                @endphp
                <b>{{$address['type']}}</b>

                {{substr($address['full_address'], 0,40)}}

                @else
                Select a Adddress
                @endif</span><i class="icofont-location-arrow"></i></a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="offers.html"><i class="icofont-search"></i> Search </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="offers.html"><i class="icofont-sale-discount"></i> Offers <span
                            class="badge badge-danger">New</span></a>
                </li>


                @auth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if ($user->thumbnail)
                        <img alt="user image" src="{{Storage::url($user->thumbnail)}}"
                            class="nav-osahan-pic rounded-pill">
                        @else
                        <img alt="user image" src="{{Storage::url('asset/default-user.png')}}"
                            class="nav-osahan-pic rounded-pill">
                        @endif
                        My Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="{{route('account.orders')}}">
                            <i class="icofont-food-cart"></i> Orders
                        </a>

                        <a class="dropdown-item" href="{{route('account.offers')}}">
                            <i class="icofont-sale-discount"></i> Offers
                        </a>

                        <a class="dropdown-item" href="{{route('account.favourites')}}">
                            <i class="icofont-heart"></i>Favourites
                        </a>

                        <a class="dropdown-item" href="{{route('account.address')}}">
                            <i class="icofont-location-pin"></i> Addresses
                        </a>

                        <a class="dropdown-item" href="route('logout')"
                            onclick="event.preventDefault();document.querySelector('#logoutForm').submit();"><i
                                class="icofont-logout"></i> Logout
                        </a>
                        <form id="logoutForm" action="{{route('logout')}}" method="post" style="display: none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}"> Login</a>
                </li>
                @endguest

                <li class="nav-item dropdown dropdown-cart">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-basket"></i> Cart
                        <span class="badge badge-success">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                        <div class="dropdown-cart-top-header p-4">
                            <img class="img-fluid mr-3" alt="osahan" src="img/cart.jpg">
                            <h6 class="mb-0">Gus's World Famous Chicken</h6>
                            <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                            <small><a class="text-primary font-weight-bold" href="#">View Full Menu</a></small>
                        </div>
                        <div class="dropdown-cart-top-body border-top p-4">
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka
                                Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                            <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn & Peas
                                Salad x 1 <span class="float-right text-secondary">$209</span></p>
                            <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh
                                Sub 6" (15 cm) x 1 <span class="float-right text-secondary">$133</span></p>
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka
                                Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn & Peas
                                Salad x 1 <span class="float-right text-secondary">$209</span></p>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-4">
                            <p class="mb-0 font-weight-bold text-secondary">Sub Total <span
                                    class="float-right text-dark">$499</span></p>
                            <small class="text-info">Extra charges may apply</small>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-2">
                            <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
