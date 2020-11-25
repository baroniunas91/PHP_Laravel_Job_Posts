<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Quill -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        
        <!-- Quilljs -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    </head>
    <body>
        <!-- Page Heading -->
        <header class="navbar">
            @include('layouts.menu')
        </header>
        <div class="messages">
            @include('layouts.messages')
        </div>
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </body>
</html>
