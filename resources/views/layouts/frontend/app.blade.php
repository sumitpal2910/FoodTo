<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Askbootstrap" />
        <meta name="author" content="Askbootstrap" />
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title')</title>

        <link rel="icon" type="image/png" href="img/favicon.png" />

        <link href="{{asset('asset/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

        <link href="{{asset('asset/frontend/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" />

        <link href="{{asset('asset/frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet" />

        <link href="{{asset('asset/frontend/vendor/select2/css/select2.min.css')}}" rel="stylesheet" />

        <link href="{{asset('asset/plugins/toastr/toastr.min.css')}}" rel="stylesheet" />

        <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />


        <link href="{{asset('asset/frontend/css/osahan.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/map.css')}}">

        <link rel="stylesheet" href="{{asset('asset/frontend/vendor/owl-carousel/css/owl.carousel.css')}}" />
        <link rel="stylesheet" href="{{asset('asset/frontend/vendor/owl-carousel/css/owl.theme.css')}}" />
    </head>

    <body>

        @include('layouts.frontend.body.header')

        @yield('content')

        @include('layouts.frontend.body.footer')

        @include('layouts.frontend.body.map')

        <script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>

        <script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>

        <script src="{{asset('asset/plugins/select2/js/select2.min.js')}}"></script>

        <script src="{{asset('asset/frontend/vendor/owl-carousel/js/owl.carousel.js')}}" defer></script>

        <script src="{{asset('asset/frontend/js/custom.js')}}" defer></script>

        <!-- bs-custom-file-input -->
        <script src="{{asset('asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}" defer></script>

        <script src="{{asset('asset\plugins\toastr\toastr.min.js')}}" defer></script>

        <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js' defer></script>


        <script src="{{asset('js/app.js')}}"></script>

        <!-- config -->
        <script src="{{asset('js/custom/config/sweetalert.js')}}" defer></script>
        <script src="{{asset('js/custom/config/ajax-request.js')}}"></script>
        <script src="{{asset('js/custom/config/config.js')}}"></script>
        <script src="{{asset('js/custom/config/function.js')}}"></script>


        <script src="{{asset('js/custom/frontend/map/helper.js')}}" defer></script>
        <script src="{{asset('js/custom/frontend/map/map.js')}}" defer></script>
        <script src="{{asset('js/custom/frontend/map/autocomplete.js')}}" defer></script>


        <!-- Notification -->
        <script>
            $(document).ready(function() {
                @if (Session::has('message'))
                    let type = "{{ Session::get('alert-type', 'info') }}";
                    switch (type) {
                    case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                    case 'success':
                    toastr.success(" {{ session('message') }}");
                    break;
                    case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                    case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
                    }
                @endif
            })
        </script>
    </body>


</html>
