<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <link rel="icon" type="image/png" href="../logo/icon.png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="{!! asset('js/effects.js') !!}"></script>

        <title>Got Change?</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: absolute;
                left: 15px;
                top: 18px;
            }

            #brand {
                max-width: 70px;
                height: auto;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                display: none;
            }

            #titleUnderline {
                max-width: 200px;
                padding-left: 150px;
                padding-right: 150px;
                padding-bottom: 10px;
                border-top: 1px solid #636b6f;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <a href="{{ url('/') }}">
                <div class="top-left">
                    <img id="brand" src="../Logo/logo.png">
                </div>
            </a>
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Got Change?
                </div>
                <span id="titleUnderline"></span>
                <h3>Your platform for trading coins.</h3>
            </div>
        </div>
    </body>
</html>
