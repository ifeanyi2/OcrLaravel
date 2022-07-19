<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" />
    <title>{{ config('app.name') }} :: @yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background: navy;color:white !important">
        <a class="navbar-brand" href="#">Trinity OCR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto text-white">


                @auth
                <li class="nav-item">
                     <a class="nav-link text-primary" href="#"><p>{{ auth()->user()->username }}</p></a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('dashboard') }}"><p>Dashboard</p></a>
                </li>
                   <li class="nav-item">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                    <button type="submit" class="btn btn-danger"
                     onclick="setCookie('data', '', null , null , null, 1);localStorage.clear();" 
                    > 
                        Logout</button>
                    </form>

                </li>

                @endauth

                @guest
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>

                @endguest




            </ul>

        </div>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script>
        function setCookie(key, value, expireDays, expireHours, expireMinutes, expireSeconds) {
        var expireDate = new Date();
        if (expireDays) {
            expireDate.setDate(expireDate.getDate() + expireDays);
        }
        if (expireHours) {
            expireDate.setHours(expireDate.getHours() + expireHours);
        }
        if (expireMinutes) {
            expireDate.setMinutes(expireDate.getMinutes() + expireMinutes);
        }
        if (expireSeconds) {
            expireDate.setSeconds(expireDate.getSeconds() + expireSeconds);
        }
        document.cookie = key +"="+ escape(value) +
            ";domain="+ window.location.hostname +
            ";path=/"+
            ";expires="+expireDate.toUTCString();
    }
    </script>
</body>

</html>
