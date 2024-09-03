<!DOCTYPE html>
<html lang="en">

    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @foreach ($posts as $post)
        <meta class="post-item" data-post-id="{{ $post->id }}">
        @endforeach
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List of All Posts</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @livewireStyles
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
                position: relative;
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

            /* Like button styling */
            .like-button {
                position: absolute;
                bottom: 10px;
                left: 10px;
                background-color: #ff4d4d;
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.3s;
            }

            .like-button:hover {
                background-color: #ff6666;
                transform: scale(1.1);
            }

            .like-button:active {
                background-color: #e60000;
            }
        </style>
    </head>

    <body>
        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="header">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                List of All Posts
            </h1>
            <div class="header-actions">

                @if (Auth::check())

                    <a href="/dashboard"
                        class="bg-yellow-500 text-gray-800 py-3 px-6 rounded-lg shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        My Profile
                    </a>
                    <a href="{{ route('posts.create') }}"
                        class="bg-gray-500 text-white py-2 px-4 rounded shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Create New Post
                    </a>
                    @livewire('online-users')

                    <a href="{{ route('logout') }}"
                        class="btn-profile flex items-center space-x-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m7 4v-4m0 0V7m0 4H7" />
                        </svg>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                    <div class="mb-4 p-4 border border-gray-200 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post->title }}</h2>
                        <p class="text-base text-gray-700 mb-2">{{ $post->body }}</p>
                        <p class="text-sm text-gray-500 text-right">{{ $post->created_at->diffForHumans() }}</p>

                        <hr>
                        <!-- Like button component -->
                        <div class="like-button-container">
                            @livewire('like-button', ['post' => $post])
                            <livewire:comments :model="$post" />
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-posts">
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 text-center mt-4">
                        No post exists...
                    </h3>

                </div>
            @endif
        </div>

        @livewireScripts

    </body>

</html>
