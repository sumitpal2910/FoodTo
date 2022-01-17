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
                        <h4 class="font-weight-bold mt-0 mb-4">Update Profile</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-secondary">Home</h6>
                                                <p class="text-black">Osahan House, Jawaddi Kalan, Ludhiana,
                                                    Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"
                                                        data-toggle="modal" data-target="#add-address-modal" href="#"><i
                                                            class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger"
                                                        data-toggle="modal" data-target="#delete-address-modal"
                                                        href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Work</h6>
                                                <p>NCC, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab
                                                    141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"
                                                        data-toggle="modal" data-target="#add-address-modal" href="#"><i
                                                            class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger"
                                                        data-toggle="modal" data-target="#delete-address-modal"
                                                        href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
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
