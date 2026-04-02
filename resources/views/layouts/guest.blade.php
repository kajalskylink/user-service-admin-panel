@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.page_title', 'Apex MPL') }} | {{ config('app.name', 'Apex MPL') }}</title>

        <meta name="description" content="{{ config('app.description') ?? '' }}">
        <meta name="keywords" content="{{ config('app.keywords') ?? '' }}">
        <meta name="author" content="{{ config('app.author') ?? '' }}">
        <meta name="robots" content="index, follow">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('app/css/swap.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/media_query.css') }}">

        <!-- Styles -->
        @livewireStyles

        @stack("styles")
    </head>
    <body>
        <div class="site_content">
            {{ $slot }}
        </div>
        @livewireScripts
        <script src="{{ asset('app/js/jquery.js') }}"></script>
        <script src="{{ asset('app/js/slick.min.js') }}"></script>
        <script src="{{ asset('app/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('app/js/script.js') }}"></script>
    </body>
</html>
