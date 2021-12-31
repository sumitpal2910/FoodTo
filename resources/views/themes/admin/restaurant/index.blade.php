@extends('layouts.admin.app')

@section('title','Restaurant ')

@section('content')
<div class="content-wrapper">

    <x-admin-content-header title="Restaurant " :count="$count" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search Box -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="searchForm" action="" method="get">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="">State </label>
                                            <select onchange="getDistrict(event)" class="form-control select2 state"
                                                name="state_id" id="">
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
                                            <select onchange="getCity(event)" class="form-control select2 district"
                                                name="district_id">
                                                <option value="" disabled selected>--Select District--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- District -->
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <select class="form-control select2 city" name="city_id">
                                                <option value="" disabled selected>--Select District--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="5">All</option>
                                                <option value="0">Pending Listed</option>
                                                <option value="1">Active</option>
                                                <option value="2">Delisted</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
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
                                    <a href="{{route('admin.restaurant.create')}}"
                                        class="btn btn-success btn-lg float-right">Add Retaurant
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="restaurantTable" class="table responsive ">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="5%">Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Owner</th>
                                        <th>Manager</th>
                                        <th>Status</th>
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





@endsection
