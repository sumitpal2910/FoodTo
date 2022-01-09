<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Askbootstrap">
        <meta name="author" content="Askbootstrap">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title')</title>

        <link rel="icon" type="image/png" href="img/favicon.png">

        <link href="{{asset('asset/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/vendor/select2/css/select2.min.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">

        <link href="{{asset('asset/frontend/css/osahan.css')}}" rel="stylesheet">
    </head>

    <body class="bg-white">

        @yield('content')



        <script src="{{asset('asset/frontend/vendor/jquery/jquery-3.3.1.min.js')}}"></script>

        <script src="{{asset('asset/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" defer>
        </script>

        <script src="{{asset('asset/frontend/vendor/select2/js/select2.full.min.js')}}"></script>
        <!-- bs-custom-file-input -->
        <script src="{{asset('asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}" defer></script>

        <script src="{{asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

        <script src="{{asset('asset/frontend/js/custom.js')}}" defer> </script>


        {{--<script src="{{asset('js/app.js')}}"></script>--}}
        <script src="{{asset('js/custom/config/config.js')}}"></script>
        <script src="{{asset('js/custom/config/function.js')}}" defer></script>
        <script src="{{asset('js/custom/config/ajax-request.js')}}" defer></script>

        <script src="{{asset('js/custom/frontend/pages/restaurant.js')}}" defer></script>

        <script>
            //document.addEventListener('DOMContentLoaded', function () {
            //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
            //});
        </script>
    </body>

</html>
