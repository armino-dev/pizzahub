<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#343a40">
    <meta name="description" content="@yield('description', config('app.name', 'PizzaHub'))">
    <title>{{ config('app.name', 'PizzaHub') }}</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'PizzaHub') }}">
    <link rel="apple-touch-icon" href="/images/icons/icon-152x152.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    @yield('additional_css')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="app">
    <div id="wrapper">
        <div id="navigation-bar">
            @include('frontend.nav')
        </div>
        <main>
            @yield('content')
        </main>

        <footer class="sticky-footer">
            @include('frontend.footer')
        </footer>
    </div>
    @include('includes/scroll-to-top')
    @yield('additional_before_js')
    <script>
        let settings = {!! json_encode(config("settings")) !!};
    </script>        
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('additional_after_js')
</body>

</html>