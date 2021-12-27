@extends('layouts.admin.app')

@section('title','Service City')

@section('content')
<div class="content-wrapper">

    <x-admin-content-header title="City" :count="$count" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search Box -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="citySearchForm" action="" method="get">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="">State *</label>
                                            <select class="form-control select2 state" name="state_id" id="" required>
                                                <option value="" disabled selected>--Select State--</option>
                                                @foreach ($states as $state)
                                                @if ($state->deleted_at)
                                                <option disabled value="{{$state->id}}">
                                                    <del>{{$state->name}} </del>(Deleted)
                                                </option>
                                                @else
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- District -->
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="">District</label>
                                            <select class="form-control select2 district" name="district_id"
                                                id="district" >
                                                <option value="" disabled selected>--Select District--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">All</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                                <option value="3">Deleted</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label for=""> &nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" id="search"
                                                class="btn btn-success btn-block">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <h3 style="display: inline;"> <span id="count"
                                            class="badge badge-pill badge-success">{{$count}}</span>
                                    </h3>
                                    <button data-toggle="modal" data-target="#modalAdd"
                                        class="btn btn-success btn-lg float-right">Add City
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cityTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>Name</th>
                                        <th>District</th>
                                        <th>State</th>
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




<!-- State Edit Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cityAdd" action="{{route('admin.city.store')}}" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">State</label>
                                <select class="form-control select state" name="state_id" id="">
                                    <option value="" disabled selected>--Select State--</option>
                                    @foreach ($states as $state)
                                    @if ($state->deleted_at)
                                    <option disabled value="{{$state->id}}">
                                        <del>{{$state->name}} </del>(Deleted)
                                    </option>
                                    @else
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- District -->
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">District</label>
                                <select class="form-control select2 district" name="district_id" id="district">
                                    <option value="" disabled selected>--Select District--</option>
                                </select>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                    placeholder="City">
                            </div>
                        </div>

                        <div class="col-12 errorDiv">
                            <ul class="text-danger errorList"></ul>
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
<!-- State Edit Modal-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cityEdit" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">State</label>
                                <select class="form-control state" name="state_id">
                                    <option value="" disabled selected>--Select State--</option>
                                    @foreach ($states as $state)
                                    @if ($state->deleted_at)
                                    <option disabled value="{{$state->id}}">
                                        <del>{{$state->name}} </del>(Deleted)
                                    </option>
                                    @else
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">District</label>
                                <select class="form-control district select2" name="district_id" id="district">
                                    <option value="" disabled selected>--Select District--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="District">
                            </div>
                        </div>

                        <div class="col-12" class="errorDiv">
                            <ul class="text-danger" class="errorList"></ul>
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
