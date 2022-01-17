@php
$route = Route::currentRouteName();
$user = Auth::user();
@endphp

<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm rounded bg-white h-100">
        <div class="border-bottom p-4">
            <div class="osahan-user text-center">
                <div class="osahan-user-media">
                    @if ($user->thumbnail)
                    <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{Storage::url($user->thumbnail)}}"
                        alt="gurdeep singh osahan">
                    @else
                    <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{Storage::url('asset/default-user.png')}}"
                        @endif <div class="osahan-user-media-body">
                    <h6 class="mb-2">{{$user->name}}</h6>
                    <p class="mb-1">+91 {{$user->phone}}</p>
                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"
                            href="{{route('account.settings')}}"><i class="icofont-ui-edit"></i> EDIT</a></p>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{$route == 'account.orders' ? 'active' : ''}}" href="{{route('account.orders')}}">
                <i class="icofont-food-cart"></i>
                Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$route == 'account.offers' ? 'active' : ''}}" href="{{route('account.offers')}}"><i
                    class="icofont-sale-discount"></i>
                Offers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$route == 'account.favourites' ? 'active' : ''}}"
                href="{{route('account.favourites')}}"><i class="icofont-heart"></i>
                Favourites</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{$route == 'account.address' ? 'active' : ''}}" href="{{route('account.address')}}"><i
                    class="icofont-location-pin"></i>
                Addresses</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{$route == 'account.settings' ? 'active' : ''}}" href="{{route('account.settings')}}"><i
                    class="icofont-settings"></i>
                Settings</a>
        </li>
    </ul>
</div>
</div>
