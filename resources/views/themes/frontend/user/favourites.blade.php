@extends('layouts.frontend.app')


@section('title', "Profile")

@section('content')
<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            <x-user-sidebar />
            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">


                        <div >
                            <h4 class="font-weight-bold mt-0 mb-4">Favourites</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/4.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Famous
                                                        Dave's Bar-B-Que
                                                    </a>
                                                </h6>
                                                <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 15–30 min</span> <span
                                                        class="float-right text-black-50"> $350 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small> Use Coupon
                                                    OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/5.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Thai
                                                        Famous Cuisine</a></h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 30–35 min</span> <span
                                                        class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-success">OFFER</span> <small>65%
                                                    off</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/6.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">The osahan
                                                        Restaurant
                                                    </a>
                                                </h6>
                                                <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 15–25 min</span> <span
                                                        class="float-right text-black-50"> $500 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65%
                                                    OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/7.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Stan's
                                                        Restaurant
                                                    </a>
                                                </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 15–25 min</span> <span
                                                        class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65% Coupon
                                                    OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/8.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Polo
                                                        Lounge
                                                    </a>
                                                </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 15–25 min</span> <span
                                                        class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small> Coupon
                                                    OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i
                                                        class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a
                                                    href="detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span
                                                    class="badge badge-dark">Promoted</span></div>
                                            <a href="detail.html">
                                                <img src="img/list/9.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Jack Fry's
                                                    </a>
                                                </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span
                                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                            class="icofont-wall-clock"></i> 15–25 min</span> <span
                                                        class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65% </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center load-more">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
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
