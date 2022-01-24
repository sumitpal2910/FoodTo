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
                                    <button type="button" data-toggle="modal" data-target="#addModal"
                                        class="btn btn-success btn-lg float-right">Add Topping </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="toppingTable" class="table responsive">
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



<!-- Edit Topping Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Topping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addTopping" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <!--Name-->
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Topping Name <span class="text-danger">*</span></label>
                                <input required type="text" name="name" class="form-control" placeholder="Topping Name">
                            </div>
                        </div>

                        <!--Price-->
                        <div class="col-lg-2 col-md-6 col-sm-12 ">
                            <div class="form-group">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input required min="0" type="number" name="price" class="form-control"
                                    placeholder="Price">
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""> Quantity </label>
                                <input required min="0" type="number" name="qty" class="form-control"
                                    placeholder="Quantity">
                            </div>
                        </div>

                        <!--Veg / Non Veg-->
                        <div class="col-lg-3 col-md-6 col-sm-12 ">
                            <label for="">Veg / Non Veg </label>
                            <div class="form-group clearfix row">
                                <div class="icheck-primary d-inline mr-5">
                                    <input type="radio" id="veg" name="veg" value="1" checked>
                                    <label for="veg">Veg </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="nonveg" name="veg" value="0">
                                    <label for="nonveg">Non Veg </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
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



@endsection