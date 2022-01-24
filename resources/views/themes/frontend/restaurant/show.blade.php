@extends('layouts.frontend.app')

@section('title', $rest->name)

@section('content')
<section class="restaurant-detailed-banner">
    <div class="text-center " style="height: 200px;">
    </div>
    <div class="restaurant-detailed-header">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-md-8">
                    <div class="restaurant-detailed-header-left">
                        <img class="img-fluid mr-3 float-left" alt="osahan" src="{{Storage::url($rest->thumbnail)}}">
                        <h2 class="text-white">{{$rest->name}}</h2>
                        <p class="text-white mb-1"><i class="icofont-location-pin"></i> {{$rest->landmark}},
                            {{$rest->area}} <span class="badge badge-success">OPEN</span>
                        </p>
                        <p class="text-white mb-0"><i class="icofont-food-cart"></i> {{$rest->cuisine}}
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant-detailed-header-right text-right">
                        <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i>
                            {{$travelTime-5}}-{{$travelTime+5}}
                            min {{$distance}} km.
                        </button>
                        <h6 class="text-white mb-0 restaurant-detailed-ratings"><span
                                class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span>
                            23 Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="offer-dedicated-nav bg-white border-top-0 shadow-sm sticky-nav">
    <div class="container ">
        <div class="row">
            <div class="col-md-12 ">
                <span class="restaurant-detailed-action-btn float-right">
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i
                            class="icofont-heart text-danger"></i> Mark as Favourite</button>
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i
                            class="icofont-cauli-flower text-success"></i> Pure Veg</button>
                    <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i>
                        OFFERS</button>
                </span>
                <ul class="nav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill"
                            href="#pills-order-online" role="tab" aria-controls="pills-order-online"
                            aria-selected="true">Order Online</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab"
                            aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill"
                            href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info"
                            aria-selected="false">Restaurant Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-book-tab" data-toggle="pill" href="#pills-book" role="tab"
                            aria-controls="pills-book" aria-selected="false">Book A Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab"
                            aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-3">
                <div id="menubox" class="sticky-div bg-white list-group" style="height:100vh">
                    @foreach ($rest->menus as $menu)

                    <a class="menu-list" href="#menu-list-{{$menu->id}}">
                        {{$menu->title}} </a>
                    @endforeach

                </div>
            </div>
            <div class="col-md-5 " style="height: 100%">
                <div id="showFoods" class="bg-white" data-spy="scroll" data-target="#menubox" data-offset="0">

                    @foreach ($rest->menus as $menu)


                    {{--<div class="bg-white mb-4">
                        <h5 id="menu-list-{{$menu->id}}" class="mb-4 pt-3 col-md-12">{{strtoupper($menu->title)}}
                            <small class="h6 text-black-50">{{count($menu->foods)}} ITEMS</small>
                        </h5>
                        <hr class="food-hr">

                        @foreach ($menu->foods as $food)

                        <!--Food That has image-->
                        <div class="gold-members pt-3 pl-3 border-bottom ">
                            <div class="row">
                                <div class="col-md-9 row">

                                    <div class="col-12">
                                        @if ($food->veg ==1)
                                        <i class="icofont-ui-press text-success food-item"></i>
                                        @else
                                        <i class="icofont-ui-press text-danger food-item"></i>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-4px">
                                        <strong>{{$food->name}}</strong>
                                    </div>
                                    <div class="col-12 mt-4px">
                                        &#8377 {{$food->price}}
                                    </div>

                                    @if($food->thumbnail)
                                    <div class="col-12 mt-4px">
                                        <small class="text-secondary">
                                            {{$food->description}}
                                        </small>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <!--Image-->
                                    @if ($food->thumbnail)
                                    <button class="btn-unset" data-toggle="modal" data-target="#show-food-modal"
                                        food-id="{{$food->id}}">
                                        <img class="img-responsive food-img" src="{{Storage::url($food->thumbnail)}}"
                                            alt="food img">
                                    </button>
                                    @endif


                                        <!--Check if in cart or not-->
                                        @if(Session::exists("cartItems.{$food->id}"))
                                        @php
                                        $sess = Session::get("cartItems.{$food->id}");
                                        @endphp
                                        <div
                                            class="btn add-btn pl-2 pr-2  d-flex justify-content-between add-btn-{{$food->thumbnail ? ' with-img':'no-img'}}">
                                            <button onclick="decrement({{$sess['rowId']}})" class="btn-unset"><i
                                                    class="icofont-minus"></i>
                                            </button>
                                            <b> {{$sess['qty']}}</b>
                                            <button id="{{$sess['rowId']}}" foodId="{{$food->id}}"
                                                onclick="increment(event)" hasToppings="{{$sess['hasToppings']}}"
                                                class="btn-unset">
                                                <i class="icofont-plus"></i>
                                            </button>
                                        </div>

                                        @else

                                        @if($food->toppings_count > 0)

                                        <div data-toggle="modal" data-target="#customizeModal"
                                            class="btn add-btn {{$food->thumbnail ? ' add-btn-with-img':'add-btn-no-img'}}">
                                            <button onclick="customize({{$food->id}})" class="btn-unset">Add
                                                <sup><i class="icofont-plus"></i></sup>
                                            </button>
                                        </div>

                                        @else


                                        <form class="addToCartForm" action="">
                                            <input type="hidden" name="restaurant_id" value="{{$rest->id}}">
                                            <input type="hidden" name="food_id" value="{{$food->id}}">
                                            <div
                                                class="btn addToCart add-btn {{$food->thumbnail ? ' add-btn-with-img':'add-btn-no-img'}}">

                                                <button class="btn-unset">Add</button>
                                            </div>
                                        </form>

                                    @endif

                                    @endif

                                </div>

                                @if(!$food->thumbnail)
                                <div class="col-12 mt-4px">
                                    <small class="text-secondary">
                                        {{$food->description}}
                                    </small>
                                </div>
                                @endif
                            </div>

                        </div>



                        @endforeach

                    </div>--}}


                    @endforeach

                </div>
            </div>
            <div class="col-md-4 ">
                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item sticky-div">
                    <h5 class="mb-1 text-white">Cart <span class="badge badge-success" id="cartCount"></span></h5>
                    <p class="mb-4 text-white" id="cartRestaurant"> </p>
                    <div class="bg-white rounded shadow-sm mb-2 overflow-auto cart" id="cartItems">


                    </div>
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger"
                                id="cartTotal"></span>
                        </h6>
                        <p class="seven-color mb-1 text-right">Extra charges may apply</p>
                    </div>
                    <a href="{{route('checkout.index')}}" class="btn btn-success btn-block btn-lg">Checkout <i
                            class="icofont-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Customize Modal-->
<div class="modal fade" id="customizeModal" tabindex="-1" role="dialog" aria-labelledby="customize" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content br-0">
            <div class="modal-header ">

                <h5 id="foodName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form  onsubmit="addToCartForm(event)" >
                <input type="hidden" id="foodId" name="food_id">
                <input type="hidden" id="restaurantId" name="restaurant_id">
                <div class="modal-body " id="showToppingsList">

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block d-flex justify-content-between"><span
                            id="foodPrice">{{__('custom.inr')}}
                        </span> <span>Add</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Food Modal-->
<div class="modal fade" id="show-food-modal" tabindex="-1" role="dialog" aria-labelledby="show-food" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive img-thumbnail modal-food-img" id="foodImg"
                            src="{{Storage::url('asset/default-image.png')}}" alt="">
                    </div>

                    <div class="col-md-9 row">
                        <div class="col-12 mt-4px">

                            <i class="icofont-ui-press text-danger food-item"></i>
                        </div>
                        <div class="col-12 mt-4px">
                            <strong>Food Name</strong>
                        </div>
                        <div class="col-md-12 mt-4px">
                            &#8377; 400
                        </div>
                    </div>

                    <div class="col-md-3">

                        <button class="btn add-btn ">Add +</button>

                    </div>

                    <div class="col-md-12 mt-4px">
                        <small class="text-secondary">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas sapiente mollitia
                            itaque,
                            libero assumenda laboriosam quia culpa tempora, nesciunt temporibus ab nemo voluptates.
                            Perferendis libero, error doloremque magnam quibusdam repudiandae!
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
