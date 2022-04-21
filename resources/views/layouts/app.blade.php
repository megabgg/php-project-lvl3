<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <script src="/js/app.js" defer></script>
    <link href="/css/app.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token"/>
</head>

<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{route('urls.create')}}">PageAnalyzer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('urls.create') ? 'active' : ''}}"
                           href="{{route('urls.create')}}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('urls.index') ? 'active' : ''}}"
                           href="{{route('urls.index')}}">Сайты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="flex-grow-1">
    @include("flash::message")
    @yield('content')
</main>
<footer class="border-top py-3 mt-5 flex-shrink-0">
    <div class="container-lg">
        <div class="text-center">
            <a href="https://github.com/megabgg" target="_blank">AndreyWeb92</a>
        </div>
    </div>
</footer>
</body>
</html>
