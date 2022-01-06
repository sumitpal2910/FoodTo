@extends('layouts.frontend.guest')

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                            <h3 class="login-heading mb-4">Welcome back!</h3>

                            <x-auth-status />
                            <x-auth-error />
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Email address" autofocus>
                                    <label for="email">Email address </label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control"
                                        placeholder="Password">
                                    <label for="inputPassword">Password</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" name="remember"
                                        id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                </div>
                                <button type="submit"
                                    class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign
                                    in</button>
                                <div class="text-center pt-3">
                                    Don’t have an account? <a class="font-weight-bold" href="">Sign
                                        Up</a>
                                </div>

                                @if (Route::has('password.request'))
                                <div class="text-center pt-3">
                                    <a href="{{ route('password.request') }}" class="font-weight-bold">
                                        Forgot your password?</a>
                                </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
