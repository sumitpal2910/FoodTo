@extends('layouts.frontend.app')


@section('title', "Profile")

@section('content')
<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            <x-user-sidebar />
            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">


                    <div>
                        <h4 class="font-weight-bold mt-0 mb-4">Settings</h4>
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="card">

                                    <div class="card-body">
                                        <form action="{{route('update.profile')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")

                                            <!--Name-->
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Name" value="{{$user->name}}">
                                            </div>

                                            <!--Email-->
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email" value="{{$user->email}}">
                                            </div>

                                            <!--Phone-->
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone" value="{{$user->phone}}">
                                            </div>

                                            <!--Image-->
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <div class="custom-file">
                                                    <input onchange="loadFile(event)" name="thumbnail" type="file"
                                                        class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <img width="100px" src="" alt="" class="preview mt-3 ">
                                            </div>

                                            <!--Button-->
                                            <div class="form-group">
                                                <label for="">&nbsp;</label>
                                                <button type="submit"
                                                    class="btn btn-success float-right">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 ">
                                <div class="card">

                                    <div class="card-body">
                                        <x-auth-error />
                                        <form action="{{route('update.password')}}" method="post">
                                            @csrf
                                            @method("PUT")

                                            <!--Current Password-->
                                            <div class="form-group">
                                                <label for="">Current Password</label>
                                                <input type="password" class="form-control" name="oldPassword"
                                                    placeholder="Current Password">
                                            </div>

                                            <!--New Password-->
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="New Password">
                                            </div>

                                            <!-- Password Confirm-->
                                            <div class="form-group">
                                                <label for="">Confirm Password</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Confirm Password">
                                            </div>


                                            <!--Button-->
                                            <div class="form-group">
                                                <label for="">&nbsp;</label>
                                                <button type="submit"
                                                    class="btn btn-success float-right">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
</section>
@endsection
