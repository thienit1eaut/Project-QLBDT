<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title_page) ? $title_page . ' - ' : '' }} Hệ thống quản lý bán hàng EAUT</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/mobile-style.css') }}">

    @yield('specificpagestyles')

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app-style.css') }}">
</head>
<body>
    <div id="main-app" class="d-flex flex-column">
        @include('header')
        
        @yield('content')

        @include('footer')
    </div>
</body>
<script defer src="{{ asset('assets/frontend/js/jquery-3.7.1.min.js') }}"></script>
<script defer src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script defer src="{{ asset('assets/frontend/js/script.js') }}"></script>

@yield('specificpagescripts')

<script defer src="{{ asset('assets/frontend/js/app-script.js') }}"></script>
</body>
</html>