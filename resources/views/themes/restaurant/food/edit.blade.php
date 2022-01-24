@extends('layouts.restaurant.app')

@section('title', 'Update Food')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Edit Food" prefix="Food / create" />

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-5">
                <!-- Left Side -->
                <div class=" col-md-12">

                    <!-- Food  -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title"> {{$food->name}} </p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('restaurant.food.update', ['food'=>$food->id])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <!--Menu-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Menu <span class="text-danger">*</span></label>
                                            <select required name="menu_id" id="" class="form-control select2">
                                                <option value="" disabled selected>--Select Menu--</option>
                                                @foreach ($menus as $item)
                                                @if ($item->id === $food->menu_id)
                                                <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                                @else
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!--Name-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Food Name <span class="text-danger">*</span></label>
                                            <input required type="text" name="name" class="form-control"
                                                placeholder="Food Name" value="{{$food->name}}">
                                            <x-error name="name" />
                                        </div>
                                    </div>

                                    <!--Description-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""> Description </label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Description" value="{{$food->description}}">
                                            <x-error name="description" />
                                        </div>
                                    </div>

                                    <!--Price-->
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="form-group">
                                            <label for="">Price <span class="text-danger">*</span></label>
                                            <input required type="number" name="price" class="form-control"
                                                placeholder="Price" value="{{$food->price}}">
                                            <x-error name="phone" />
                                        </div>
                                    </div>

                                    <!--Quantity-->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""> Quantity </label>
                                            <input type="number" name="qty" class="form-control" placeholder="Quantity"
                                                value="{{$food->qty}}">
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
                                                <input type="radio" id="radioPrimary1" name="type" value="0"
                                                    {{$food->type == 0? 'checked':''}}>
                                                <label for="radioPrimary1">Veg </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="type" value="1"
                                                    {{$food->type == 1? 'checked':''}}>
                                                <label for="radioPrimary2">Non Veg </label>
                                            </div>
                                        </div>
                                    </div>



                                    <!--Toppings-->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Toppings</label>
                                            <select name="topping_id[]" id="" multiple class="form-control select2">
                                                @foreach ($food->toppings as $item)
                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach

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
                                            <img width="100px" src="{{Storage::url($food->thumbnail)}}" alt=""
                                                class="preview mt-3 ">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success float-right">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Food: End -->


                    <!--  ------------------------------------------------------------------------------------------------------ -->


                    <!-- Update Toppings  -->
                    {{--<div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title"> Toppings </p>
                        </div>
                        <div class="card-body ">

                            <table  id="foodoppingTable" class="table responsive">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>--}}
                    <!-- Update Toppings: End -->


                    <!-- --------------------------------------------------------------------------------------------------------------- -->

                    <!--  Timing -->
                    <div class="card mb-5 card-primary">
                        <div class="card-header">
                            <p class="card-title">Timing</p>
                            <button data-toggle="modal" data-target="#addTimingModal"
                                class="btn btn-success float-right">Add New</button>
                        </div>
                        <div class="card-body">
                            <table foodId={{$food->id}} class="table responsive" id="foodTimingTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Day</th>
                                        <th>Open</th>
                                        <th>Close</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Timing: End -->

                </div>
                <!-- Left Side: End -->

            </div>
        </div>
    </section>
</div>

<!-- Edit Topping Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Topping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTopping" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <!--Name-->
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Topping Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Topping Name">
                            </div>
                        </div>

                        <!--Price-->
                        <div class="col-lg-2 col-md-6 col-sm-12 ">
                            <div class="form-group">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input min="0" type="number" name="price" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""> Quantity </label>
                                <input min="0" type="number" name="qty" class="form-control" placeholder="Quantity">
                            </div>
                        </div>

                        <!--Veg / Non Veg-->
                        <div class="col-lg-3 col-md-6 col-sm-12 ">
                            <label for="">Veg / Non Veg </label>
                            <div class="form-group clearfix row">
                                <div class="icheck-primary d-inline mr-5">
                                    <input type="radio" id="veg" name="type" value="0">
                                    <label for="veg">Veg </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="nonveg" name="type" value="1">
                                    <label for="nonveg">Non Veg </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Timing Modal -->
<div class="modal fade" id="addTimingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Add Timing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addFoodTiming" method="POST"
                action="{{route('restaurant.food.timing.store', ['food'=>$food->id])}}">
                <div class="modal-body">

                    <div class="row">
                        <!--Day-->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Day <span class="text-danger">*</span></label>
                                @php
                                $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                                @endphp
                                <select required name="day" id="" class="form-control">
                                    @foreach ($days as $day)
                                    <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--Open-->
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <div class="form-group">
                                <label for="">Open <span class="text-danger">*</span></label>
                                <input class="form-control" type="time" name="open" required>
                            </div>
                        </div>

                        <!--Close-->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""> Close <span class="text-danger">*</span> </label>
                                <input required type="time" name="close" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Timing Modal -->
<div class="modal fade" id="editTimingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Topping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editFoodTiming" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <!--Day-->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Day <span class="text-danger">*</span></label>
                                @php
                                $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                                @endphp
                                <select name="day" id="timingDay" class="form-control">
                                    @foreach ($days as $day)
                                    <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--Open-->
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <div class="form-group">
                                <label for="">Open <span class="text-danger">*</span></label>
                                <input class="form-control" type="time" name="open" required>
                            </div>
                        </div>

                        <!--Close-->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""> Close <span class="text-danger">*</span> </label>
                                <input required type="time" name="close" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection