<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ route('index') }}">

    <title>{{ config('app.name') }} &middot; @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/solid.css" integrity="sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-1rquJLNOM3ijoueaaeS5m+McXPJCGdr5HcA03/VHXxcp2kX2sUrQDmFc3jR5i/C7" crossorigin="anonymous">
    @mix('css/app.css')
    @stack('styles')

</head>
<body class="bg-light">



        <div class="loader-page"></div>

        @include('layouts.dashboard.navbar')

        @include('layouts.dashboard.navdrawer')

        <main class="content-wrapper pt-4 mt-1" id="app">
            <div class="container pb-3">

                @yield('content')

            </div>

            @include('layouts.partials.scroll_top')

            @include('layouts.dashboard.footer')
        </main>



    @mix('js/manifest.js')
    @mix('js/vendor.js')
    @mix('js/app.js')
    @mix('js/dashboard.js')
    @include('sweetalert::alert')
    @stack('scripts')

</body>
</html>
