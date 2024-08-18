<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f0f4f8;
                color: #333;
            }

            nav {
                display: flex;
                justify-content: flex-end;
                padding: 10px 20px;
                background-color: #ffffff;
                border-bottom: 1px solid #ddd;
            }

            nav a {
                text-decoration: none;
                color: #333;
                padding: 8px 16px;
                margin: 0 5px;
                border-radius: 4px;
                transition: background-color 0.3s, color 0.3s;
            }

            nav a:hover {
                background-color: #f0f0f0;
                color: #007bff;
            }

            .dark-mode {
                background-color: #000;
                color: #fff;
            }

            .dark-mode nav a {
                color: #fff;
            }

            .dark-mode nav a:hover {
                background-color: #333;
                color: #fff;
            }
        </style>
    </head>

    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        @endif

    </body>

</html>
