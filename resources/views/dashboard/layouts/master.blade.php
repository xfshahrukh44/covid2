<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts icons-->
    <script src="https://kit.fontawesome.com/57c2c45ef3.js" crossorigin="anonymous"></script>

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
</style>
<body class="bg-white">
    <nav class="navbar navbar-light" style="background:#12274A;">
        <div class="container-fluid">
            <a class="navbar-brand text-white">
                <img src="{{asset('dashboard/Group9674.png')}}" alt="">
                Sistema Automático de trazabilidad
            </a>
            <div class="d-flex logout_div">
                <a class="text-white logout_btn"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out"></i>  Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>
    <div id="app">
        <main class="py-4 ">
            @yield('content')
        </main>
    </div>
</body>
</html>
