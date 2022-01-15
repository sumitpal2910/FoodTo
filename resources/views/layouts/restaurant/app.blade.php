<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title')</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('asset/plugins/fontawesome-free/css/all.min.css')}}">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{asset('asset/plugins/bootstrap/css/bootstrap.min.css')}}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet"
            href="{{asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('asset/plugins/select2/css/select2.min.css')}}">
        <!-- daterange picker -->
        <link rel="stylesheet" href="{{asset('asset/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- tagsinput -->
        <link rel="stylesheet" href="{{asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
        <!-- iCheck for checkbox and radio button -->
        <link rel="stylesheet" href="{{asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

        <!-- Veg Nonveg icon -->
        <link rel="stylesheet" href="http://static.sasongsmat.nu/fonts/vegetarian.css" />
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('asset/dist/css/adminlte.min.css')}}">
        <script>
            function prefix(link) {
                return "restaurant/"+link
            };
        </script>
    </head>

    <body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
        <div class="wrapper">
            <!--Loader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{asset('storage/asset/logo/logo-short.png')}}" alt="FoodTo"
                    height="60" width="60">
            </div>

            <!--Header -->
            @include('layouts.restaurant.body.header')

            <!--Sidebar -->
            @include('layouts.restaurant.body.sidebar')



            <!--Page Content -->
            @yield('content')




            <!--Footer -->
            @include('layouts.restaurant.body.footer')

        </div>
        <!-- jQuery -->
        <script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
        <!-- Toastr-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
        <!-- Select2 -->
        <script src="{{asset('asset/plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>
        <script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}" defer></script>
        <script src="{{asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}" defer>
        </script>
        <!-- bs-custom-file-input -->
        <script src="{{asset('asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}" defer></script>
        <!-- date-range-picker -->
        <script src="{{asset('asset/plugins/daterangepicker/daterangepicker.js')}}" defer></script>
        <!--tagsinput-->
        <script src="{{asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}" defer></script>

        <!-- AdminLTE App -->
        <script src="{{asset('asset/dist/js/adminlte.js')}}" defer></script>



        <!-- ========= CUSTOM ======== -->
        <script src="{{asset('js/app.js')}}" defer></script>

        <!-- config -->
        <script src="{{asset('js/custom/config/config.js')}}"></script>
        <script src="{{asset('js/custom/config/sweetalert.js')}}" defer></script>
        <script src="{{asset('js/custom/config/ajax-request.js')}}" defer></script>
        <script src="{{asset('js/custom/config/function.js')}}"></script>

        <script src="{{asset('js\custom\restaurant\pages\food.js')}}" defer></script>
        <script src="{{asset('js\custom\restaurant\pages\foodTopping.js')}}" defer></script>
        <script src="{{asset('js\custom\restaurant\pages\foodTiming.js')}}" defer></script>
        <script src="{{asset('js\custom\restaurant\pages\menu.js')}}" defer></script>


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