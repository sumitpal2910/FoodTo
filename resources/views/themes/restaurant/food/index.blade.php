@extends('layouts.restaurant.app')

@section('title','Food')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Food" :count="$count" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 ">
                                    <div class="form-group">
                                        <select id="foodStatus" class="form-control">
                                            <option value="0">All</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            <option value="3">Deleted</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-12">
                                    <h3 style="display: inline;"> <span id="count"
                                            class="badge badge-pill badge-success">{{$count}}</span>
                                    </h3>
                                    <a href="{{route('restaurant.food.create')}}"
                                        class="btn btn-success btn-lg float-right">Add Food </a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="foodTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="10%">Image</th>
                                        <th>Name</th>
                                        <th width="10%">Toppings</th>
                                        <th width="10%">Available</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Price</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>


<!-- Topping Modal -->
<div class="modal fade" id="toppingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> "<span id="foodName"></span>" Toppings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-sm table-responsive">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="toppingName">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" id="editButton" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Timing Modal -->
<div class="modal fade" id="timingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> "<span id="timingFoodName"></span>" Timing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-sm table-responsive">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th>Day</th>
                            <th>Open</th>
                            <th>Close</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="timingName">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" id="editTimingButton" class="btn btn-outline-primary btn-sm"><i
                        class="fas fa-pencil-alt"></i></a>
            </div>
        </div>
    </div>
</div>


@endsection
