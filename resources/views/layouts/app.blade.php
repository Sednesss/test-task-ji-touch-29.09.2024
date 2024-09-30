<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/site/includes/header.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/site/layouts/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
    <title>@yield('title')</title>
</head>

<body>
    @stack('scripts')
    @include('includes.site.header')
    <div class="content">
        @yield('content')
    </div>
</body>

</html>