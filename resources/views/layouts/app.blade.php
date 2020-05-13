<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var serverTime = moment().format('MMMM Do, YYYY - hh:mm:ss');
            $(".serverTime").text(serverTime);

            setInterval(function () {
                $('.serverTime').text(moment().format('MMMM Do, YYYY - HH:mm:ss'));
            }, 1000);
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/storage/assets/flower.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <span class="logo">Online Florist</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse margin-horizontal" id="navbarSupportedContent">
                    @if(Auth::check())
                        <ul class="nav navbar-nav margin-horizontal">
                            <li><a style="color:grey;text-decoration:none;" href="{{ route('profile') }}">Profile</a></li>
                        </ul>

                        @if(Auth::user()->role == "Admin")
                            <ul class="navbar-nav mr-auto">
                                <ul class="navbar-nav ml-auto margin-horizontal">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Admin Menu <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('manageflowers') }}">
                                                {{ __('Manage Flowers') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('manageflowertypes') }}">
                                                {{ __('Manage Flower Types') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('managecouriers') }}">
                                                {{ __('Manage Couriers') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('manageusers') }}">
                                                {{ __('Manage Users') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('transactionhistory') }}">
                                                {{ __('Transaction History') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                        @elseif(Auth::user()->role == "Member")
                            <ul class="navbar-nav mr-auto">
                                <ul class="navbar-nav ml-auto margin-horizontal">
                                    <a style="color:grey;text-decoration:none;" href="{{ route('cart') }}">
                                        View Cart
                                    </a>
                                </ul>
                            </ul>
                        @endif
                    @endif
                    
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div style="margin-top:8px;margin-right:10px;">
                                <span style="font-size:8pt;" class="serverTime"></span>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>
</body>
</html>


