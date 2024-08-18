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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        nav .nav-links {
            display: flex;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            margin: 0 8px;
            border-radius: 4px;
            font-weight: 600;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #e0e0e0;
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

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .button:active {
            background-color: #004494;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <nav>
        <div class="nav-links">
            @auth
                <a href="{{ url('/profile') }}">Profile</a>
            @else
                <a href="{{ route('login') }}">Log In</a>

                @if (Route::has('register'))
                    <a href="{{ route('posts.index') }}" class="button">Home Page</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </nav>

</body>

</html>
