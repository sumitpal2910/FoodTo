@extends('layouts.rider.app')

@section('title', 'Profile')


@section('content')
<div class="content-wrapper">

    <x-content-header title="Profile" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($rider->thumbnail)
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{Storage::url($rider->thumbnail)}}" alt="User profile picture">
                                @else
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{Storage::url('asset/default-image.png')}}" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$rider->name}}</h3>

                            <p class="text-muted text-center">Delivery Partner</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$rider->address}}</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile"
                                        data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address &
                                        Document</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <form action="{{route('rider.profile.update.profile')}}" class="row" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!--Name-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="" class="form-control"
                                                    value="{{$rider->name}}">
                                            </div>
                                            <x-error name="name" />
                                        </div>

                                        <!--Email-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Email <span class="text-danger">*</span></label>
                                                <input type="text" name="email" id="" class="form-control"
                                                    value="{{$rider->email}}">
                                            </div>
                                            <x-error name="email" />
                                        </div>

                                        <!--Phone-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" id="" class="form-control"
                                                    value="{{$rider->phone}}">
                                            </div>
                                            <x-error name="phone" />
                                        </div>

                                        <!--Image -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Image </label>
                                                <div class="custom-file">
                                                    <input onchange="loadFile(event)" name="thumbnail" type="file"
                                                        class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <img width="100px" src="" alt="" class="preview mt-3 ">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success float-right">Update</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="address">
                                    <form action="" class="row">
                                        <!-- State -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">State <span class="text-danger">*</span></label>
                                                <select required onchange="getDistrict(event)"
                                                    class="form-control select2 state" name="state_id">
                                                    @foreach ($states as $state)
                                                    @if ($state->deleted_at)
                                                    <option disabled value="{{$state->id}}">
                                                        <del>{{$state->name}} </del>(Deleted)
                                                    </option>
                                                    @elseif($restaurant->state_id === $state->id)
                                                    <option selected value="{{$state->id}}">{{$state->name}}
                                                    </option>
                                                    @else
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <x-error name="state_id" />
                                            </div>
                                        </div>

                                        <!-- District -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">District <span class="text-danger">*</span></label>
                                                <select required onchange="getCity(event)"
                                                    class="form-control select2 district" name="district_id">
                                                    @foreach ($districts as $district)
                                                    @if ($district->id === $restaurant->district_id)
                                                    <option selected value="{{$district->id}}">{{$district->name}}
                                                    </option>
                                                    @else
                                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <x-error name="district_id" />
                                            </div>
                                        </div>

                                        <!-- CIty -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">City <span class="text-danger">*</span></label>
                                                <select required class="form-control select2 city" name="city_id">
                                                    @foreach ($cities as $city)
                                                    @if ($city->id === $restaurant->city_id )
                                                    <option value="{{$city->id}}" selected> {{$city->name}}
                                                    </option>

                                                    @else
                                                    <option value="{{$city->id}}"> {{$city->name}} </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <x-error name="city_id" />
                                            </div>
                                        </div>

                                        <!--Address-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address <span class="text-danger">*</span></label>
                                                <textarea rows="2" name="address" id=""
                                                    class="form-control">{{$rider->address}}</textarea>
                                            </div>
                                            <x-error name="address" />
                                        </div>

                                        <!--Pincode-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Pincode <span class="text-danger">*</span></label>
                                                <input type="text" name="pincode" id="" class="form-control"
                                                    value="{{$rider->pincode}}">
                                            </div>
                                            <x-error name="pincode" />
                                        </div>

                                        <!--Image -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Kyc</label>
                                                <div class="custom-file">
                                                    <input onchange="loadFile(event)" name="kyc" type="file"
                                                        class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success float-right">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="row" method="post">
                                        @method("PUT")
                                        @csrf
                                        <!--Old Password-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Current Password <span
                                                        class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="passwordOld"
                                                    placeholder="Current Password">
                                            </div>
                                            <x-error name="passwordOld" />
                                        </div>

                                        <!--Password-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">New Password <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="password"
                                                    placeholder="Current Password">
                                            </div>
                                            <x-error name="password" />
                                        </div>

                                        <!--Password Confirm-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">New Password Confirm <span
                                                        class="text-danger">*</span></label>
                                                <input required type="text" class="form-control"
                                                    name="password_confirmation" placeholder="Current Password">
                                            </div>
                                            <x-error name="password_confirmation" />
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary float-right">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
