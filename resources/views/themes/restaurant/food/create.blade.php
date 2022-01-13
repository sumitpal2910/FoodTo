@extends('layouts.restaurant.app')

@section('title', 'Add Food')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Add Food" prefix="Food / create" />

    <section class="content">
        <div class="container-fluid">
            <form class="mb-5" action="{{route('restaurant.food.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-5">
                    <!-- Left Side -->
                    <div class=" col-md-12">

                        <!-- Food  -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <p class="card-title">Add Food </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!--Name-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Food Name <span class="text-danger">*</span></label>
                                            <input required type="text" name="name" class="form-control"
                                                placeholder="Food Name" value="{{old('name')}}">
                                            <x-error name="name" />
                                        </div>
                                    </div>

                                    <!--Description-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""> Description </label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Description" value="{{old('description')}}">
                                            <x-error name="description" />
                                        </div>
                                    </div>

                                    <!--Price-->
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="form-group">
                                            <label for="">Price <span class="text-danger">*</span></label>
                                            <input required type="number" name="price" class="form-control"
                                                placeholder="Price" value="{{old('price')}}">
                                            <x-error name="phone" />
                                        </div>
                                    </div>

                                    <!--Quantity-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""> Quantity </label>
                                            <input type="number" name="qty" class="form-control" placeholder="Quantity"
                                                value="{{old('qty')}}">
                                            <small class="text-secondary">
                                                <i>How much quantity food make per day</i>
                                            </small>
                                            <x-error name="qty" />
                                        </div>
                                    </div>

                                    <!--Veg / Non Veg-->
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <label for="">Veg / Non Veg </label>
                                        <div class="form-group">
                                            <div class="icheck-primary d-inline mr-5">
                                                <input type="radio" id="radioPrimary1" name="type" value="0" checked>
                                                <label for="radioPrimary1">Veg </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="type" value="1">
                                                <label for="radioPrimary2">Non Veg </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Image -->
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="form-group">
                                            <label for="">Image </label>
                                            <div class="custom-file">
                                                <input onchange="loadFile(event)" name="thumbnail" type="file"
                                                    class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose
                                                    file</label>
                                            </div>
                                            <x-error name="thumbnail" />
                                            <img width="100px" src="" alt="" class="preview mt-3 ">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Food: End -->


                        <!--  ------------------------------------------------------------------------------------------------------ -->


                        <!-- Add Toppings  -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <p class="card-title">Add Toppings (Optional) </p>
                            </div>
                            <div class="card-body ">
                                <div class="addToppingDiv">
                                    <div class="row" id="0">
                                        <!--Name-->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Topping Name <span class="text-danger">*</span></label>
                                                <input type="text" name="topping_name[]" class="form-control"
                                                    placeholder="Topping Name" value="{{old('topping_name[]')}}">
                                            </div>
                                        </div>

                                        <!--Price-->
                                        <div class="col-lg-2 col-md-6 col-sm-12 ">
                                            <div class="form-group">
                                                <label for="">Price <span class="text-danger">*</span></label>
                                                <input min="0" type="number" name="topping_price[]" class="form-control"
                                                    placeholder="Price" value="{{old('topping_price[]')}}">
                                            </div>
                                        </div>

                                        <!--Quantity-->
                                        <div class="col-lg-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Quantity </label>
                                                <input min="0" type="number" name="topping_qty[]" class="form-control"
                                                    placeholder="Quantity" value="{{old('topping_qty[]')}}">
                                            </div>
                                        </div>

                                        <!--Veg / Non Veg-->
                                        <div class="col-lg-3 col-md-5 col-sm-12 ">
                                            <label for="">Veg / Non Veg </label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline mr-5">
                                                    <input type="radio" id="radio0" name="topping_type[0]" value="0"
                                                        checked>
                                                    <label for="radio0">Veg </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radio1" name="topping_type[0]" value="1">
                                                    <label for="radio1">Non Veg </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Remove Button-->
                                        <div class="col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Remove</label>
                                                <button onclick="removeTopping('0')" type="button"
                                                    class="btn text-danger"><i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <button radio="1" id="addTopping" type="button" title="Add New Topping"
                                        class="btn text-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Add Toppings: End -->


                        <!--  ------------------------------------------------------------------------------------------------------ -->


                        <!--  Timing -->
                        <div class="card mb-5 card-primary">
                            <div class="card-header">
                                <p class="card-title"><b class="mr-5"> Timing</b>

                                    @foreach ($restaurantTiming as $timing)
                                    @if ($timing->status ===1 )
                                    <x-badge class="success ml-2" :text="$timing->day" />
                                    @else
                                    <x-badge class="danger ml-2" :text="$timing->day" />
                                    @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    @php
                                    $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday",
                                    "Friday",
                                    "Saturday"];
                                    @endphp
                                    @foreach ($days as $day)

                                    <!-- Sunday -->
                                    <div class="col-md-12 row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input onchange="timingInput(event)" type="checkbox"
                                                            name="status[{{$day}}]">
                                                    </span>
                                                </div>
                                                <input type="text" name="day[]" class="form-control" value="{{$day}}"
                                                    readonly="">
                                            </div>
                                        </div>

                                        <!-- Open -->
                                        <div class="timingInput col-md-4 col-sm-6 invisible">
                                            <div class="form-group">
                                                <input type="time" name="open[{{$day}}]" class="form-control">
                                            </div>
                                        </div>
                                        <!--Close-->
                                        <div class="timingInput col-md-4 col-sm-6 invisible">
                                            <div class="form-group">
                                                <input type="time" name="close[{{$day}}]" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <!-- Timing: End -->

                    </div>
                    <!-- Left Side: End -->

                    <div class="col-12 mt-3 mb-3">
                        <button type="submit" class="btn btn-success btn-lg float-right">Add New</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


@endsection
