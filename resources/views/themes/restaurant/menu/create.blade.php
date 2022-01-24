@extends('layouts.restaurant.app')

@section('title', 'Create Menu')

@section('content')
<div class="content-wrapper">

    <x-content-header title="Create Menu" prefix="Menu / create" />

    <section class="content">
        <div class="container-fluid">
            <form class="mb-5" action="{{route('restaurant.menus.store')}}" method="POST">
                @csrf
                <div class="row mb-5">
                    <!-- Left Side -->
                    <div class=" col-md-12">

                        <!-- Food  -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <p class="card-title">Create Menu</p>
                            </div>
                            <div class="card-body">
                                <div class="row">




                                </div>
                            </div>
                        </div>
                        <!-- Food: End -->



                    </div>
                    <!-- Left Side: End -->

                    <div class="col-12 mt-3 mb-3">
                        <button type="submit" class="btn btn-success btn-lg float-right">Add New</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>



@endsection
