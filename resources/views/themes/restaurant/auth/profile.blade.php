@extends('layouts.restaurant.app')

@section('title', 'Profile')


@section('content')


<!-- Main content -->
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
                                <img src="{{Storage::url($restaurant->bg_image)}}" alt="" class="img-fluid">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{Storage::url($restaurant->thumbnail)}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$restaurant->name}}</h3>
                            <p class="text-muted text-center">Owner: {{$restaurant->owner->name}}</p>


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
                            <h3 class="card-title">About </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$restaurant->address}}, {{$restaurant->city->name}},
                                {{$restaurant->state->name}}, {{$restaurant->pincode}}
                            </p>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Cuisine</strong>

                            @php
                            $cuisines = explode(",", $restaurant->cuisine);
                            @endphp
                            <p>
                                @foreach ($cuisines as $item)
                                <span class="badge badge-pill badge-danger">{{$item}}</span>
                                @endforeach
                            </p>
                            <hr>


                            <strong><i class="far fa-clock mr-1"></i> Timing</strong>
                            <p>
                                @foreach ($restaurant->timing as $timing)
                                <span class="text-muted">{{$timing->day}}: {{$timing->open}} - {{$timing->close}}</span>
                                <br>
                                @endforeach
                            </p>
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
                                <li class="nav-item">
                                    <a class="nav-link active" href="#details" data-toggle="tab">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#address" data-toggle="tab">Address</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#owner" data-toggle="tab">Owner</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#manager" data-toggle="tab">Manager</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#timing" data-toggle="tab">Timing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#document" data-toggle="tab">Document</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#files" data-toggle="tab">Files</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#password" data-toggle="tab">Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!--Details-->
                                <div class="active tab-pane" id="details">
                                    <form class="row"
                                        action="{{route('restaurant.profile.update.details', ['restaurant'=>$restaurant->id])}}"
                                        method="post" enctype="multipart/form-data">

                                        @csrf
                                        @method("PUT")
                                        <!--Name-->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Restaurant Name <span class="text-danger">*</span></label>
                                                <input required type="text" name="name" class="form-control"
                                                    placeholder="Restaurant Name" value="{{$restaurant->name}}">
                                                <x-error name="name" />
                                            </div>
                                        </div>

                                        <!--Cuisine-->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Cuisine <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input required type="text" name="cuisine" data-role="tagsinput"
                                                            class="form-control" value="{{$restaurant->cuisine}}">
                                                    </div>
                                                </div>
                                                <x-error name="cuisine" />
                                            </div>
                                        </div>

                                        <!--Email-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Email <span class="text-danger">*</span></label>
                                                <input required type="email" name="email" class="form-control"
                                                    placeholder="Email id" value="{{$restaurant->email}}">
                                            </div>
                                            <x-error name="email" />
                                        </div>

                                        <!--Phone-->
                                        <div class="col-md-6 col-sm-12 ">
                                            <div class="form-group">
                                                <label for="">Phone <span class="text-danger">*</span></label>
                                                <input required type="text" name="phone" class="form-control"
                                                    placeholder="Phone" value="{{$restaurant->phone}}">
                                                <x-error name="phone" />
                                            </div>
                                        </div>

                                        <!--Alternate Phone-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Alternate Phone </label>
                                                <input type="text" name="alt_phone" class="form-control"
                                                    placeholder="Alternate Phone" value="{{$restaurant->alt_phone}}">
                                                <x-error name="alt_phone" />
                                            </div>
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

                                        <!-- Cover Image -->
                                        <div class="col-md-6 col-sm-12 ">
                                            <div class="form-group">
                                                <label for="">Cover Image</label>
                                                <div class="custom-file">
                                                    <input onchange="loadFile(event)" name="bg_image" type="file"
                                                        class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>

                                                <img width="200px" src="" alt="" class="preview mt-3 ">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right" type="submit">Update</button>
                                        </div>


                                    </form>
                                </div>
                                <!--Details: End-->

                                <!---------------------------------------------------------------------------------------->


                                <!--Address-->
                                <div class="tab-pane" id="address">
                                    <!-- Row -->
                                    <form class="row"
                                        action="{{route('restaurant.profile.update.address', ['restaurant'=>$restaurant->id])}}"
                                        method="post">
                                        @csrf
                                        @method("PUT")

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

                                        <!-- Pincode -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Pincode <span class="text-danger">*</span></label>
                                                <input required type="text" name="pincode" class="form-control"
                                                    placeholder="pincode" value="{{$restaurant->pincode}}">
                                                <x-error name="pincode" />
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Address <span class="text-danger">*</span></label>
                                                <input required name="address" class="form-control"
                                                    placeholder="Building and Street" value="{{$restaurant->address}}">
                                                <x-error name="address" />
                                            </div>
                                        </div>

                                        <!-- Latitude -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Latitude<span class="text-danger">*</span></label>
                                                <input required type="text" name="latitude" class="form-control"
                                                    placeholder="Latitude" value="{{$restaurant->latitude}}">
                                                <x-error name="latitude" />
                                            </div>
                                        </div>

                                        <!-- Longitude -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Longitude <span class="text-danger">*</span></label>
                                                <input required type="text" name="longitude" class="form-control"
                                                    placeholder="Longitude" value="{{$restaurant->longitude}}">
                                                <x-error name="longitude" />
                                            </div>
                                        </div>

                                        <!--Button-->
                                        <div class="col-md-12">

                                            <button class="btn btn-primary float-right" type="submit">Update</button>

                                        </div>
                                    </form>
                                    <!--end row-->
                                </div>
                                <!--Address: End-->

                                <!---------------------------------------------------------------------------------------->


                                <!--Owner-->
                                <div class="tab-pane" id="owner">
                                    <form class="row"
                                        action="{{route('restaurant.profile.update.owner',['restaurant'=>$restaurant->id])}}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <!--Owner Name-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Name <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="name"
                                                    placeholder="Name" value="{{$restaurant->owner->name}}">
                                                <x-error name="name" />
                                            </div>
                                        </div>

                                        <!--Phone -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Phone <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="phone"
                                                    placeholder="Phone" value="{{$restaurant->owner->phone}}">
                                                <x-error name="phone" />
                                            </div>
                                        </div>

                                        <!-- Alternate Phone -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Alternate Phone </label>
                                                <input type="text" class="form-control" name="alt_phone"
                                                    placeholder="Alternate Phone"
                                                    value="{{$restaurant->owner->alt_phone}}">
                                                <x-error name="alt_phone" />
                                            </div>
                                        </div>

                                        <!--Bank Name-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Bank Name <span class="text-danger">*</span></label>
                                                <select name="bank_id" class="form-control" id="">
                                                    @foreach ($banks as $bank)
                                                    @if ($bank->id === $restaurant->owner->bank_id)
                                                    <option value="{{$bank->id}}" selected>{{$bank->name}}</option>
                                                    @else
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <x-error name="bank_id" />
                                            </div>
                                        </div>

                                        <!--Account No-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Account No <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="account_no"
                                                    placeholder="Account No" value="{{$restaurant->owner->account_no}}">
                                                <x-error name="account_no" />
                                            </div>
                                        </div>

                                        <!--IFSC Code-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> IFSC Code <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="ifsc"
                                                    placeholder="IFSC Code" value="{{$restaurant->owner->ifsc}}">
                                                <x-error name="ifsc" />
                                            </div>
                                        </div>

                                        <!--Passbook-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""> Passbook</label>
                                                <div class="custom-file">
                                                    <input name="passbook" type="file" class="custom-file-input"
                                                        id="passbook">
                                                    <label class="custom-file-label" for="passbook">Choose
                                                        file</label>
                                                </div>
                                                <x-error name="passbook" />
                                                <small class="text-secondary">Passbook Details Page</small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary float-right" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!--Owner: End-->
                                <!---------------------------------------------------------------------------------------->


                                <!--Manager-->
                                <div class="tab-pane" id="manager">
                                    <form
                                        action="{{route('restaurant.profile.update.manager', ['restaurant'=>$restaurant->id])}}"
                                        method="POST" class="row">
                                        @csrf
                                        @method("PUT")
                                        <!-- Name-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Name <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="name"
                                                    placeholder="Name" value="{{$restaurant->manager->name}}">
                                            </div>
                                        </div>

                                        <!--Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Phone <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="phone"
                                                    placeholder="Phone" value="{{$restaurant->manager->phone}}">
                                            </div>
                                        </div>

                                        <!-- Alternate Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Alternate Phone </label>
                                                <input type="text" class="form-control" name="alt_phone"
                                                    placeholder="Alternate Phone"
                                                    value="{{$restaurant->manager->alt_phone}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!--Manager: End-->


                                <!---------------------------------------------------------------------------------------->


                                <!--Timing-->
                                <div class="tab-pane" id="timing">
                                    <form
                                        action="{{route('restaurant.profile.update.timing', ['restaurant'=>$restaurant->id])}}"
                                        method="POST" class="row">
                                        @csrf
                                        @method('PUT')
                                        @php
                                        $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",
                                        "Saturday"];
                                        @endphp
                                        @foreach ($restaurant->timing as $timing)

                                        <!-- Sunday -->
                                        <div class="col-md-12 row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input onchange="timingInput(event)" type="checkbox"
                                                                name="status[{{$timing->day}}]" {{$timing->status === 1
                                                            ? 'checked' :''}}>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="day[]" class="form-control"
                                                        value="{{$timing->day}}" readonly="">
                                                    <input type="hidden" name="id[{{$timing->day}}]"
                                                        value="{{$timing->id}}">
                                                </div>
                                            </div>
                                            <!-- Open -->
                                            <div class="timingInput col-md-4 col-sm-6 {{$timing->status === 1
                                                ? 'visible' :'invisible'}}">
                                                <div class="form-group">
                                                    <input type="time" name="open[{{$timing->day}}]"
                                                        class="form-control" value="{{$timing->open}}">
                                                </div>
                                            </div>
                                            <!--Close-->
                                            <div class="timingInput col-md-4 col-sm-6 {{$timing->status === 1
                                                ? 'visible' :'invisible'}}">
                                                <div class="form-group">
                                                    <input type="time" name="close[{{$timing->day}}]"
                                                        class="form-control" value="{{$timing->close}}">
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach

                                        <div class="col-12">
                                            <button class="btn btn-primary float-right">Update</button>
                                        </div>

                                    </form>
                                </div>
                                <!--Timing: End-->


                                <!---------------------------------------------------------------------------------------->


                                <!--Document-->
                                <div class="tab-pane" id="document">
                                    <form
                                        action="{{route('restaurant.profile.update.document', ['restaurant'=>$restaurant->id])}}"
                                        class="row" method="post">
                                        @method("PUT")
                                        @csrf
                                        <!--Trade Name-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Trade Name <span class="text-danger">*</span></label>
                                                <input required="" type="text" class="form-control" name="trade_name"
                                                    placeholder="Trade Name" value="{{$restaurant->trade_name}}">
                                            </div>
                                            <x-error name="trade_name" />
                                        </div>

                                        <!--GST No-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">GST Number<span class="text-danger">*</span></label>
                                                <input required="" type="text" class="form-control" name="gst_no"
                                                    placeholder="GST Number" value="{{$restaurant->gst_no}}">
                                            </div>
                                            <x-error name="gst" />
                                        </div>

                                        <!--License Number-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">License Number<span class="text-danger">*</span></label>
                                                <input required="" type="text" class="form-control" name="license_no"
                                                    placeholder="License Number" value="{{$restaurant->license_no}}">
                                            </div>
                                            <x-error name="license_no" />
                                        </div>

                                        <!--Fssai Number-->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Fssai Number<span class="text-danger">*</span></label>
                                                <input required="" type="text" class="form-control" name="fssai_no"
                                                    placeholder="Fssai Number" value="{{$restaurant->fssai_no}}">
                                            </div>
                                            <x-error name="fssai_no" />
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary float-right">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!--Document: End-->

                                <!---------------------------------------------------------------------------------------->


                                <!--Files-->
                                <div class="tab-pane" id="files">
                                    <form
                                        action="{{route('restaurant.profile.update.files', ['restaurant'=>$restaurant->id])}}"
                                        class="row" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <!--Kyc -->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="">KYC </label>
                                                <div class="custom-file">
                                                    <input name="kyc" type="file" class="custom-file-input"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--FSSAI Image -->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="">FSSAI </label>
                                                <div class="custom-file">
                                                    <input name="fssai_image" type="file" class="custom-file-input"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--License Image -->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="">License </label>
                                                <div class="custom-file">
                                                    <input name="license_image" type="file" class="custom-file-input"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Menu -->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Menu</label>
                                                <div class="custom-file">
                                                    <input name="menu" type="file" class="custom-file-input"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary float-right">Update</button>
                                        </div>

                                    </form>
                                </div>
                                <!--Files: End-->

                                <!---------------------------------------------------------------------------------------->


                                <!--Password-->
                                <div class="tab-pane" id="password">
                                    <form
                                        action="{{route('restaurant.profile.update.password', ['restaurant'=>$restaurant->id])}}"
                                        class="row" method="post">
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
                                <!--Password: End-->
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
<!-- /.content -->
@endsection