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
                                    <!--Menu-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Menu <span class="text-danger">*</span></label>
                                            <select required name="menu_id" id="" class="form-control select2">
                                                <option value="" disabled selected>--Select Menu--</option>
                                                @foreach ($menus as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

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
                                                <input type="radio" id="radioPrimary1" name="veg" value="1" checked>
                                                <label for="radioPrimary1">Veg </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="veg" value="0">
                                                <label for="radioPrimary2">Non Veg </label>
                                            </div>
                                        </div>
                                    </div>



                                    <!--Toppings-->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Toppings</label>
                                            <select name="topping_id[]" id="" multiple class="form-control select2">
                                                @foreach ($toppings as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!--Image -->
                                    <div class=" col-md-6 col-sm-12 ">
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





                        <!--  Timing -->
                        <div class="card mb-5 card-primary">
                            <div class="card-header">
                                <p class="card-title"><b class="mr-5"> Timing</b>

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
