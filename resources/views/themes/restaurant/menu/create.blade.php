@extends('layouts.restaurant.app')

@section('title', 'Create Menu')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Create Menu" prefix="Menu / create" />

    <section class="content">
        <div class="container-fluid">
            <form class="mb-5" action="{{route('restaurant.menus.store')}}" method="POST" >
                @csrf
                <div class="row mb-5">
                    <!-- Left Side -->
                    <div class=" col-md-12">

                        <!-- Food  -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <p class="card-title">Create Menu</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!--Title-->
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Menu Title <span class="text-danger">*</span></label>
                                            <input required type="text" name="title" class="form-control"
                                                placeholder="Menu Title" value="{{old('title')}}">
                                            <x-error name="title" />
                                        </div>
                                    </div>

                                    <!--Summary-->
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""> Summary </label>
                                            <input type="text" name="summary" class="form-control" placeholder="Summary"
                                                value="{{old('summary')}}">
                                            <x-error name="summary" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Select Food</label>
                                            <select name="food_id[]" id="" class="form-control select2" multiple>
                                                <option value="null" selected disabled>--Select Food--</option>
                                                @foreach ($foods as $food)
                                                <option value="{{$food->id}}">{{$food->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Food: End -->



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
