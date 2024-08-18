<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of All Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .header .title {
            color: #FFD700;
            margin: 0;
        }

        .header .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header a {
            text-decoration: none;
            color: #333;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .header a:hover {
            background-color: #f0f0f0;
            color: #007bff;
        }

        .header .btn-profile {
            display: inline-block;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .header .btn-profile:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .header .btn-profile:active {
            background-color: #004494;
        }

        .posts {
            padding: 80px 20px 20px;
        }

        .posts .post-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .posts .post-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .posts .post-item h2 {
            margin: 0;
            color: #333;
        }

        .posts .post-item p {
            margin: 0;
            color: #555;
            overflow: hidden;
        }

        .posts .post-item hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .posts .no-posts {
            text-align: center;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="title">List of All Posts</h1>
        <div class="header-actions">
            @if (Auth::check())
                <a href="/profile" class="btn-profile">
                    My Profile
                </a>
                <a href="{{ route('posts.create') }}" class="btn-profile">
                    Create New Post
                </a>
                <a href="{{ route('logout') }}" class="btn-profile" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endif
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="posts">
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="post-item">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <hr>
                </div>
            @endforeach
        @else
            <div class="no-posts">
                <h3>No post exists...</h3>
            </div>
        @endif
    </div>
</body>

</html>
