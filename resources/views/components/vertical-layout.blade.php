<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | SIMKEPON</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    {{ $css ?? '' }}

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <!-- Additional Styles -->
    {{ $styles ?? '' }}

    @vite([])
</head>
<body>
    <div class="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <x-partials.navbar-vertical />
            <div class="main-sidebar sidebar-style-2">
                <x-partials.sidebar />
            </div>

            <div class="main-content">
                {{ $content }}
            </div>

            <x-partials.footer />
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/libs/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraries -->
    {{ $js ?? '' }}

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    {{ $scripts ?? '' }}
</body>
</html>