@extends('layouts.frontend.app')

@section('title', 'Restaurants')

@section('content')
<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
    <h1 class="text-white">Offers Near You</h1>
    <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
</section>
<section class="section pt-5 pb-5 products-listing">
    <div class="container">
        <div class="row d-none-m">
            <div class="col-md-12">
                <div class="dropdown float-right">
                    <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by: <span class="text-theme">Distance</span> &nbsp;&nbsp;
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 ">
                        <a class="dropdown-item" href="#">Distance</a>
                        <a class="dropdown-item" href="#">No Of Offers</a>
                        <a class="dropdown-item" href="#">Rating</a>
                    </div>
                </div>
                <h4 class="font-weight-bold mt-0 mb-3">OFFERS <small class="h6 mb-0 ml-2">299 restaurants
                    </small>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">

                <x-sidebar-filter />

            </div>
            <div class="col-md-9">
                <div class="owl-carousel owl-carousel-category owl-theme list-cate-page mb-4">
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/1.png" alt="">
                                <h6>American</h6>
                                <p>156</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/2.png" alt="">
                                <h6>Pizza</h6>
                                <p>120</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/3.png" alt="">
                                <h6>Healthy</h6>
                                <p>130</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/4.png" alt="">
                                <h6>Vegetarian</h6>
                                <p>120</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/5.png" alt="">
                                <h6>Chinese</h6>
                                <p>111</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/6.png" alt="">
                                <h6>Hamburgers</h6>
                                <p>958</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/7.png" alt="">
                                <h6>Dessert</h6>
                                <p>56</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/8.png" alt="">
                                <h6>Chicken</h6>
                                <p>40</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/9.png" alt="">
                                <h6>Indian</h6>
                                <p>156</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @foreach ($restaurants as $rest)
                    {{-- Get distance --}}
                    @php
                    if(Session::exists('user-address')){
                    $user = Session::get('user-address');
                    }else {
                    $user = ['latitude'=> $rest->latutude, 'longitude'=>$rest->longitude];
                    }

                    $dist= distance($user['longitude'], $user['latitude'], $rest->lognitude, $rest->latitude);
                    $timing = roundNumber(travelTime($dist));
                    @endphp

                    <div class="col-md-4 col-sm-6 mb-4 pb-2">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-success"><i
                                            class="icofont-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute"><a
                                        href="{{route('restaurants.show', ['restaurants'=>$rest->slug])}}"><i
                                            class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge badge-dark">Promoted</span></div>
                                <a href="{{route('restaurants.show', ['restaurants'=>$rest->slug])}}">
                                    <img src="{{Storage::url($rest->thumbnail)}}" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a
                                            href="{{route('restaurants.show', ['restaurants'=>$rest->slug])}}"
                                            class="text-black">{{$rest->name}}</a>
                                    </h6>
                                    <p class="text-gray mb-3">
                                        @php
                                        $cuisines = explode(",", $rest->cuisine);
                                        @endphp
                                        @foreach ($cuisines as $cuisine)
                                        {{$cuisine}} •
                                        @endforeach
                                    </p>
                                    <p class="text-gray mb-3 time"><span
                                            class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                class="icofont-wall-clock"></i> {{$timing-5}} - {{$timing+5}} min</span>
                                        <span class="float-right text-black-50"> $250 FOR TWO</span>
                                    </p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon
                                        OSAHAN50</small>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach


                    <div class="col-md-12 text-center load-more">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection