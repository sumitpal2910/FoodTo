@extends('layouts.frontend.guest')

@section('title', 'Partner with us')

@section('content')

<div class="container-fluid">
    <div class="row no-gutter">
        <div class="col-md-12">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">

                        <form action="{{route('restaurant.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-5">
                                <!-- Left Side -->
                                <div class="col-lg-6 col-md-12">
                                    <!-- Details  -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Details </p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!--Name-->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">Restaurant Name <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" name="name" class="form-control"
                                                            placeholder="Restaurant Name" value="{{old('name')}}">
                                                        <x-error name="name" />
                                                    </div>
                                                </div>

                                                <!--Cuisine-->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label style="" for="">Cuisine<span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Cuisine</label>
                                                                    <input type="text" name="cuisine"
                                                                        class="form-control">
                                                                </div>
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
                                                            placeholder="Email id" value="{{old('email')}}">
                                                    </div>
                                                    <x-error name="email" />
                                                </div>

                                                <!--Password-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Password <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" name="password" class="form-control"
                                                            placeholder="Password">
                                                    </div>
                                                    <x-error name="password" />
                                                </div>

                                                <!--Phone-->
                                                <div class="col-md-6 col-sm-12 ">
                                                    <div class="form-group">
                                                        <label for="">Phone <span class="text-danger">*</span></label>
                                                        <input required type="text" name="phone" class="form-control"
                                                            placeholder="Phone" value="{{old('phone')}}">
                                                        <x-error name="phone" />
                                                    </div>
                                                </div>

                                                <!--Alternate Phone-->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for=""> Alternate Phone <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="alt_phone" class="form-control"
                                                            placeholder="Alternate Phone" value="{{old('alt_phone')}}">
                                                        <x-error name="alt_phone" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Details: End -->

                                    <!--  ------------------------------------------------------------------------------------------------------ -->


                                    <!--  Document -->
                                    <div class="card mb-5  card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Document</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!--Trade Name-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Trade Name <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="trade_name" placeholder="Trade Name"
                                                            value="{{old('trade_name')}}">
                                                        <x-error name="trade_name" />
                                                    </div>
                                                </div>

                                                <!--GST No-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">GST Number<span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control" name="gst_no"
                                                            placeholder="GST Number" value="{{old('gst_no')}}">
                                                        <x-error name="gst_no" />
                                                    </div>
                                                </div>

                                                <!--License Number-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">License Number<span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="license_no" placeholder="License Number"
                                                            value="{{old('license_no')}}">
                                                        <x-error name="license_no" />
                                                    </div>
                                                </div>

                                                <!--Fssai Number-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Fssai Number<span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control" name="fssai_no"
                                                            placeholder="Fssai Number" value="{{old('fssai_no')}}">
                                                        <x-error name="fssai_no" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Document: End -->


                                    <!--  ------------------------------------------------------------------------------------------------------ -->

                                    <!--  Owner -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Owner</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!--Owner Name-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Name <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="owner_name" placeholder="Name"
                                                            value="{{old('owner_name')}}">
                                                        <x-error name="owner_name" />
                                                    </div>
                                                </div>

                                                <!--Phone -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> Phone <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="owner_phone" placeholder="Phone"
                                                            value="{{old('owner_phone')}}">
                                                        <x-error name="owner_phone" />
                                                    </div>
                                                </div>

                                                <!-- Alternate Phone -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Alternate Phone </label>
                                                        <input type="text" class="form-control" name="owner_alt_phone"
                                                            placeholder="Alternate Phone"
                                                            value="{{old('owner_alt_phone')}}">
                                                        <x-error name="owner_alt_phone" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Owner: End -->



                                    <!--  ------------------------------------------------------------------------------------------------------ -->

                                    <!--  Timing -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Timing</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                @php
                                                $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday",
                                                "Friday",
                                                "Saturday"];
                                                @endphp
                                                @foreach ($days as $day)

                                                <!-- Sunday -->
                                                <div class="col-md-12 row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <input onchange="timingInput(event)" type="checkbox"
                                                                        name="status[{{$day}}]">
                                                                </span>
                                                            </div>
                                                            <input type="text" name="timing_day[]" class="form-control"
                                                                value="{{$day}}" readonly="">
                                                        </div>
                                                    </div>
                                                    <!-- Open -->
                                                    <div class="timingInput col-md-4 col-sm-6 invisible">
                                                        <div class="form-group">
                                                            <input type="time" name="timing_open[{{$day}}]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--Close-->
                                                    <div class="timingInput col-md-4 col-sm-6 invisible">
                                                        <div class="form-group">
                                                            <input type="time" name="timing_close[{{$day}}]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timing: End -->
                                </div>
                                <!-- Left Side: End -->

                                <!-- =============================================================================================================================== -->

                                <!-- Right Side -->
                                <div class="col-lg-6 col-md-12 ">

                                    <!-- Address -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Address </p>
                                        </div>
                                        <div class="card-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <!-- State -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">State <span class="text-danger">*</span></label>
                                                        <select required onchange="getDistrict(event)"
                                                            class="form-control select2 state" name="state_id">
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
                                                        <x-error name="state_id" />
                                                    </div>
                                                </div>

                                                <!-- District -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">District <span
                                                                class="text-danger">*</span></label>
                                                        <select required onchange="getCity(event)"
                                                            class="form-control select2 district" name="district_id">
                                                            <option value="" disabled selected>--Select District--
                                                            </option>
                                                        </select>
                                                        <x-error name="district_id" />
                                                    </div>
                                                </div>

                                                <!-- CIty -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">City <span class="text-danger">*</span></label>
                                                        <select required class="form-control select2 city"
                                                            name="city_id">
                                                            <option value="" disabled selected>--Select City--</option>
                                                        </select>
                                                        <x-error name="city_id" />
                                                    </div>
                                                </div>

                                                <!-- Pincode -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Pincode <span class="text-danger">*</span></label>
                                                        <input required type="text" name="pincode" class="form-control"
                                                            placeholder="pincode" value="{{old('pincode')}}">
                                                        <x-error name="pincode" />
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Address <span class="text-danger">*</span></label>
                                                        <input required name="full_address" class="form-control"
                                                            placeholder="Building and Street"
                                                            value="{{old('full_address')}}">
                                                        <x-error name="full_address" />
                                                    </div>
                                                </div>

                                                <!-- Area -->
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Area <span class="text-danger">*</span></label>
                                                        <input required name="area" class="form-control"
                                                            placeholder="Area" value="{{old('area')}}">
                                                        <x-error name="area" />
                                                    </div>
                                                </div>

                                                <!-- Landmark -->
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Landmark <span
                                                                class="text-danger">*</span></label>
                                                        <input required name="landmark" class="form-control"
                                                            placeholder="Landmark" value="{{old('landmark')}}">
                                                        <x-error name="landmark" />
                                                    </div>
                                                </div>


                                                <!-- lat -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">lat<span class="text-danger">*</span></label>
                                                        <input required type="text" name="lat" class="form-control"
                                                            placeholder="lat" value="{{old('lat')}}">
                                                        <x-error name="lat" />
                                                    </div>
                                                </div>

                                                <!-- long -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">long <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" name="long"
                                                            class="form-control" placeholder="long"
                                                            value="{{old('long')}}">
                                                        <x-error name="long" />
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>
                                    </div>
                                    <!-- Address: End-->

                                    <!--  ------------------------------------------------------------------------------------------------------ -->

                                    <!--  Bank Details -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Bank Details</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <!--Bank Name-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Bank Name <span
                                                                class="text-danger">*</span></label>
                                                        <select name="bank_id" id="" required class="form-control">
                                                            <option value="" selected disabled>--Select Bank--</option>
                                                            @foreach ($banks as $bank)
                                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-error name="bank_id" />
                                                    </div>
                                                </div>

                                                <!--Account No-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Account No <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="account_no" placeholder="Account No"
                                                            value="{{old('account_no')}}">
                                                        <x-error name="account_no" />
                                                    </div>
                                                </div>

                                                <!--IFSC Code-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> IFSC Code <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control" name="ifsc"
                                                            placeholder="IFSC Code" value="{{old('ifsc')}}">
                                                        <x-error name="ifsc" />
                                                    </div>
                                                </div>

                                                <!--Passbook-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Passbook <span
                                                                class="text-danger">*</span></label>
                                                        <div class="custom-file">
                                                            <input required name="passbook" type="file"
                                                                class="custom-file-input" id="passbook">
                                                            <label class="custom-file-label" for="passbook">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="passbook" />
                                                        <small class="text-secondary">Passbook Details Page</small>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bank Details: End -->

                                    <!--  Files -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Files</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <!--Kyc -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">KYC <span class="text-danger">*</span></label>
                                                        <div class="custom-file">
                                                            <input required name="kyc" type="file"
                                                                class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="kyc" />
                                                    </div>
                                                </div>

                                                <!--FSSAI Image -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">FSSAI <span class="text-danger">*</span> </label>
                                                        <div class="custom-file">
                                                            <input required name="fssai_image" type="file"
                                                                class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="fssai_image" />
                                                    </div>
                                                </div>

                                                <!--License Image -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">License <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input required name="license_image" type="file"
                                                                class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="license_image" />
                                                    </div>
                                                </div>

                                                <!--Menu -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">Menu <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input name="menu" type="file" class="custom-file-input"
                                                                id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="menu" />
                                                    </div>
                                                </div>

                                                <!--Image -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">Image <span class="text-danger">*</span></label>
                                                        <div class="custom-file">
                                                            <input required onchange="loadFile(event)" name="thumbnail"
                                                                type="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="thumbnail" />
                                                        <img width="100px" src="" alt="" class="preview mt-3 ">
                                                    </div>
                                                </div>

                                                <!-- Cover Image -->
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="">Cover Image</label>
                                                        <div class="custom-file">
                                                            <input required onchange="loadFile(event)" name="bg_image"
                                                                type="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <x-error name="bg_image" />

                                                        <img width="200px" src="" alt="" class="preview mt-3 ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Files: End -->


                                    <!--  ------------------------------------------------------------------------------------------------------ -->

                                    <!--  Manager -->
                                    <div class="card mb-5 card-primary">
                                        <div class="card-header">
                                            <p class="card-title">Manager</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Name-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Name <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="manager_name" placeholder="Name"
                                                            value="{{old('manager_name')}}">
                                                        <x-error name="manager_name" />
                                                    </div>
                                                </div>

                                                <!--Phone -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> Phone <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="manager_phone" placeholder="Phone"
                                                            value="{{old('manager_phone')}}">
                                                        <x-error name="manager_phone" />
                                                    </div>
                                                </div>

                                                <!-- Alternate Phone -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Alternate Phone </label>
                                                        <input required type="text" class="form-control"
                                                            name="manager_alt_phone" placeholder="Alternate Phone"
                                                            value="{{old('manager_alt_phone')}}">
                                                        <x-error name="manager_alt_phone" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Manager: End -->
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
