@extends('layouts.restaurant.app')

@section('title','Menu')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Menu" :count="$count" />

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
                                    <a data-toggle="modal" data-target="#addModal"
                                        class="btn btn-success btn-lg float-right">Add Menu </a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="menuTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Name</th>
                                        <th>Foods</th>
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


<!-- Add Menu Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <span id="MenuName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addMenu" action="{{route('restaurant.menus.create')}}" method="post">
                <div class="modal-body">
                    <!--Title-->
                    <div class="form-group">
                        <label for="">Menu Title <span class="text-danger">*</span></label>
                        <input required type="text" name="title" class="form-control" placeholder="Menu Title"
                            value="{{old('title')}}">
                        <x-error name="title" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Menu Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <span id="MenuName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMenu" method="post">
                <div class="modal-body">
                    <!--Title-->
                    <div class="form-group">
                        <label for="">Menu Title <span class="text-danger">*</span></label>
                        <input required type="text" name="title" class="form-control" placeholder="Menu Title"
                            value="{{old('title')}}">
                        <x-error name="title" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Topping Modal -->
<div class="modal fade" id="foodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <span id="MenuName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="" class="table responsive ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="menuFoodTable">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" id="editButton" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
            </div>
        </div>
    </div>
</div>




@endsection
