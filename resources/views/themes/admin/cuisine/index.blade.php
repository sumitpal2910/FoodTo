@extends('layouts.admin.app')

@section('title','Cuisine')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Cuisine" :count="$count" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 ">
                                    <div class="form-group">
                                        <select id="cuisineStatus" class="form-control">
                                            <option value="0">All</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            <option value="3">Deleted</option>
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-8 d-sm-none d-md-block">

                                </div>--}}
                                <div class="col-md-10 col-sm-12">
                                    <h3 style="display: inline;"> <span id="count"
                                            class="badge badge-pill badge-success">{{$count}}</span>
                                    </h3>
                                    <button type="button" class="btn btn-success btn-lg float-right" data-toggle="modal"
                                        data-target="#modalAdd">Add Cuisine </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cuisineTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
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

<!-- State Add Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Cusine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cuisineAdd" action="{{route('admin.cuisine.store')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="">Cusine</label>
                                <input type="text" name="name" class="form-control" placeholder="Cuisine">
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="">Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input required="" onchange="loadFile(event)" name="thumbnail" type="file"
                                        class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose
                                        file</label>
                                </div>
                                <img width="100px" src="" alt="" class="preview mt-3 ">
                            </div>
                        </div>
                        <div class="col-12 errorDiv">
                            <ul class="text-danger errorList"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="" type="submit" class="btn btn-success">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- State Edit Modal-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Cusine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cuisineEdit" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="">Cuisine</label>
                                <input type="text" name="name" class="form-control" placeholder="Cuisine">
                            </div>

                            <div class="form-group">
                                <label for="">Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input required="" onchange="loadFile(event)" name="thumbnail" type="file"
                                        class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose
                                        file</label>
                                </div>
                                <img width="100px" src="" alt="" class="preview mt-3 ">
                            </div>
                        </div>
                        <div class="col-12" class="errorDiv">
                            <ul class="text-danger" class="errorList"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="" type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
