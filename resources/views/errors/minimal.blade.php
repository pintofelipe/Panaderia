<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .error {
            font-size: 40px;
        }

        .msg {
            font-size: 25px;
        }

        .btn {
            display: block;
            margin: 20px;
            padding: 20px;
            font-size: 40px;
        }

        .error,
        .msg,
        .btn {
            text-align: center;
        }

        .error {
            margin-top: 10%;
        }

        .btn {
            background-color: hsl(39, 83%, 52%);
            margin: 50px auto;
            width: fit-content;
            border-radius: 30px;
        }

        .btn,
        .btn:visited {
            color: white;
            text-decoration: none
        }
    </style>
</head>

<body>

    <div class="error">
        Ocurrió un error catastrófico: @yield('code')
    </div>

    <div class="msg">
        Mensaje: @yield('message')
    </div>

    <a class="btn" href="{{ route('home') }}">
        Ir a Inicio
    </a>
</body>

</html>