<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Course Management System
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/../assets/demo/demo.css" rel="stylesheet" />

</head>
<style>
    .red {
        color: red !important;
    }

    .green {
        color: green !important;
    }

    .fa-trash {
        background: none;
        border: none;

    }
</style>

<body>
    <div class="wrapper ">
        @if(Auth::check())
        @include('layouts.sidebar')
        @endif
        <div class="main-panel">

            @include('layouts.nav')


            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.footer')
    <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
</body>

</html>