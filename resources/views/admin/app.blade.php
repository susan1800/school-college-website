<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/logo/toplogo.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/logo/toplogo.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/logo/toplogo.png')}}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
</head>
<body class="app sidebar-mini rtl">
@include('admin.partials.header')
@include('admin.partials.sidebar')
<main class="app-content" id="app">
    @yield('content')
</main>

<script src="{{ asset('backend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('backend/js/popper.min.js')}}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js')}} "></script>
<script src="{{ asset('backend/js/main.js')}}"></script>
<script src="{{ asset('backend/js/plugins/pace.min.js')}}"></script>

@stack('scripts')

</body>
</html>
