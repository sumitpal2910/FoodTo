<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Askbootstrap" />
    <meta name="author" content="Askbootstrap" />
    <title>Osahan Eat - Online Food Ordering Website HTML Template</title>

    <link rel="icon" type="image/png" href="img/favicon.png" />

    <link href="{{asset('asset/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('asset/frontend/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" />

    <link href="{{asset('asset/frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet" />

    <link href="{{asset('asset/frontend/vendor/select2/css/select2.min.css')}}" rel="stylesheet" />

    <link href="{{asset('asset/frontend/css/osahan.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('asset/frontend/vendor/owl-carousel/css/owl.carousel.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/frontend/vendor/owl-carousel/css/owl.theme.css')}}" />
</head>

<body>

    @include('layouts.frontend.body.header')

    @yield('content')

    @include('layouts.frontend.body.footer')

    <script src="{{asset('asset/frontend/vendor/jquery/jquery-3.3.1.slim.min.js')}}"></script>

    <script src="{{asset('asset/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('asset/frontend/vendor/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('asset/frontend/vendor/owl-carousel/js/owl.carousel.js')}}"></script>

    <script src="{{asset('asset/frontend/js/custom.js')}}"></script>

</body>

</html>