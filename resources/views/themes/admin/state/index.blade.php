@extends('layouts.admin.app')

@section('title','Service State')

@section('content')
<div class="content-wrapper">

    <x-admin-content-header title="State" :count="$count" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 ">
                                    <div class="form-group">
                                        <select id="stateStatus" class="form-control">
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
                                        data-target="#modalStateAdd">Add State </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="stateTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Name</th>
                                        <th>Code</th>
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
<div class="modal fade" id="modalStateAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="stateAdd" action="{{route('admin.state.store')}}" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="State">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Code">
                            </div>
                        </div>
                        <div class="col-12 errorDiv">
                            <ul class="text-danger errorList"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="stateAddBtn" type="submit" class="btn btn-success">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- State Edit Modal-->
<div class="modal fade" id="modalStateEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="stateEdit" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="State">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Code">
                            </div>
                        </div>
                        <div class="col-12" class="errorDiv">
                            <ul class="text-danger" class="errorList"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="stateEditBtn" type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
