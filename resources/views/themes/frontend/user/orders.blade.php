@extends('layouts.frontend.app')


@section('title', "Orders")

@section('content')
<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            <x-user-sidebar />
            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">

                    <div>
                        <h4 class="font-weight-bold mt-0 mb-4">Past Orders</h4>
                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                <a href="#">
                                    <div class="media">
                                        <img class="mr-4" src="img/3.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <span class="float-right text-info">Delivered on Mon, Nov 12, 7:18
                                                PM <i class="icofont-check-circled text-success"></i></span>
                                            <h6 class="mb-2">
                                                <a href="detail.html" class="text-black">Gus's World Famous
                                                    Fried Chicken
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> 730
                                                S Mendenhall Rd, Memphis, TN 38117, USA
                                            </p>
                                            <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER
                                                #25102589748 <i class="icofont-clock-time ml-2"></i> Mon, Nov
                                                12, 6:26 PM</p>
                                            <p class="text-dark">Veg Masala Roll x 1, Veg Burger x 1, Veg Penne
                                                Pasta in Red Sauce x 1
                                            </p>
                                            <hr>
                                            <div class="float-right">
                                                <a class="btn btn-sm btn-outline-primary" href="#"><i
                                                        class="icofont-headphone-alt"></i> HELP</a>
                                                <a class="btn btn-sm btn-primary" href="detail.html"><i
                                                        class="icofont-refresh"></i> REORDER</a>
                                            </div>
                                            <p class="mb-0 text-black text-primary pt-2"><span
                                                    class="text-black font-weight-bold"> Total Paid:</span> $300
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                <a href="#">
                                    <div class="media">
                                        <img class="mr-4" src="img/4.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <span class="float-right text-info">Delivered on Mon, Nov 12, 7:18
                                                PM <i class="icofont-check-circled text-success"></i></span>
                                            <h6 class="mb-2">
                                                <a href="detail.html" class="text-black">Jimmy's Famous American
                                                    Tavern
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-1"><i class="icofont-location-arrow"></i>
                                                1733 Ocean Ave, Santa Monica, CA 90401, USA
                                            </p>
                                            <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER
                                                #25102589748 <i class="icofont-clock-time ml-2"></i> Mon, Nov
                                                12, 6:26 PM</p>
                                            <p class="text-dark">Veg Masala Roll x 5, Veg Burger x 1, Veg Penne
                                                Pasta in Red Sauce x 1
                                            </p>
                                            <hr>
                                            <div class="float-right">
                                                <a class="btn btn-sm btn-outline-primary" href="#"><i
                                                        class="icofont-headphone-alt"></i> HELP</a>
                                                <a class="btn btn-sm btn-primary" href="detail.html"><i
                                                        class="icofont-refresh"></i> REORDER</a>
                                            </div>
                                            <p class="mb-0 text-black text-primary pt-2"><span
                                                    class="text-black font-weight-bold"> Total Paid:</span> $500
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="bg-white card  order-list shadow-sm">
                            <div class="gold-members p-4">
                                <a href="#">
                                    <div class="media">
                                        <img class="mr-4" src="img/5.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <span class="float-right text-info">Delivered on Mon, Nov 12, 7:18
                                                PM <i class="icofont-check-circled text-success"></i></span>
                                            <h6 class="mb-2">
                                                <a href="detail.html" class="text-black">The Famous Restaurant
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> 953
                                                S Main St, Centerville, OH 45459, USA
                                            </p>
                                            <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER
                                                #25102589748 <i class="icofont-clock-time ml-2"></i> Mon, Nov
                                                12, 6:26 PM</p>
                                            <p class="text-dark">Veg Masala Roll x 5, Veg Penne Pasta in Red
                                                Sauce x 1
                                            </p>
                                            <hr>
                                            <div class="float-right">
                                                <a class="btn btn-sm btn-outline-primary" href="#"><i
                                                        class="icofont-headphone-alt"></i> HELP</a>
                                                <a class="btn btn-sm btn-primary" href="detail.html"><i
                                                        class="icofont-refresh"></i> REORDER</a>
                                            </div>
                                            <p class="mb-0 text-black text-primary pt-2"><span
                                                    class="text-black font-weight-bold"> Total Paid:</span> $420
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>
@endsection
