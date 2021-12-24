@extends('layouts.frontend.guest')

@section('title', 'Sing Up')

@section('content')
{{-- <div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                            <h3 class="login-heading mb-4">New Buddy!</h3>
                            <x-auth-status />
                            <x-auth-error />
                            <form method="POST" action="{{ route('register') }}">
                                <!-- Name -->
                                <div class="form-label-group">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                    <label for="name">Name</label>
                                </div>
                                <!-- Name -->
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control"
                                        placeholder="Password">
                                    <label for="inputPassword">Password</label>
                                </div>
                                <div class="form-label-group mb-4">
                                    <input type="text" id="ptext" class="form-control" placeholder="Promocode">
                                    <label for="ptext">Promocode</label>
                                </div>
                                <a href="index.html"
                                    class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign
                                    Up</a>
                                <div class="text-center pt-3">
                                    Already have an Account? <a class="font-weight-bold" href="login.html">Sign
                                        In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
