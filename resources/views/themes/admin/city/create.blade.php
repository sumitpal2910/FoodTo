@extends('layouts.admin.app')

@section('title', 'Add new city')

@section('content')
<div class="content-wrapper">
    <x-content-header title="Add New City" prefix="City / Create" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <dov class="card">
                        <div class="card-header">
                            &nbsp;
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.city.store')}}" method="post">
                                @csrf
                                <!-- State -->
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control select2" name="state_id" id="state">
                                                <option value="" disabled selected>--Select State--</option>
                                                @foreach ($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- District -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="">District</label>
                                            <select class="form-control select2" name="district_id" id="district">
                                                <option value="" disabled selected>--Select District--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- City-->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                                placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <x-auth-error />
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Add New</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </dov>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
