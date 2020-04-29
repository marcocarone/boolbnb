<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Boolbnb - progetto realizzato da: Marco carone, Nicola Baglini, Andrea Pacifico, Luisa Logozzo, Gianuario Fiore">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- script tom tom --}}
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps-web.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">


    {{-- css tom tom --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps.css' />
<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

</head>
