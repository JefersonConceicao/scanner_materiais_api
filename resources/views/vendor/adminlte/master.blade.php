<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="{{ asset("assets/favicon.ico") }}"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> 
            @yield('title_prefix', config('adminlte.title_prefix', ''))
            @yield('title', config('adminlte.title', 'BT_Source'))
            @yield('title_postfix', config('adminlte.title_postfix', ''))
        </title>
        <meta name="csrf-token" content="{{ csrf_token()}}"/> 
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/lou-multi-select/css/multi-select.css') }}">
        @include('adminlte::plugins', ['type' => 'css'])
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}"/>
        @yield('adminlte_css')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>

    <body class="hold-transition @yield('body_class') layout-boxed">
            @yield('body')

        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/lou-multi-select/js/jquery.multi-select.js') }}"> </script>
        <script src="{{ asset('vendor/jquery.quick-search/dist/jquery.quicksearch.js') }}"> </script>
        <script> 
            var arrayPermissions = '<?php echo json_encode(session()->get("user_permissions")); ?>' 
        </script>
        @include('adminlte::plugins', ['type' => 'js'])
        @yield('adminlte_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js">  </script>
        <script src="{{ asset('js/app.js')}}"> </script>
    </body>
</html>
