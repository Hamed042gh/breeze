<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Profile</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 20px;
            }

            .post-item {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 15px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .btn {
                margin-right: 5px;
            }

            .post-title {
                font-size: 1.25rem;
                font-weight: bold;
                color: #007bff;
            }

            .post-actions {
                margin-top: 10px;
            }

            .header-actions {
                position: absolute;
                top: 10px;
                right: 20px;
                display: flex;
                gap: 10px;
                /* Space between buttons */
            }

            .header-actions .btn {
                font-size: 0.9rem;
                /* Adjust font size if needed */
            }

            .create-post-btn {
                margin-right: 15px;
                /* Add margin for spacing */
            }

            .btn-warning {
                background-color: #ffc107;
                border: none;
            }

            .btn-warning:hover {
                background-color: #e0a800;
            }

            .btn-danger {
                background-color: #dc3545;
                border: none;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }
        </style>
    </head>

    <body>
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="header-actions">
                @if (Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endif
            </div>

            <a href="{{ url('/dashboard') }}" class="btn btn-primary back-btn">
                <i class="fa fa-arrow-left"></i> Back to Dashboard
            </a>

            <h1>Welcome : {{ $user->name }}</h1>
            <p>Total Posts: {{ $postCount }}</p>

            @if ($posts->isNotEmpty())
                @foreach ($posts as $post)
                    <div class="post-item">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <p>{{ $post->body }}</p>
                        <hr>
                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <div class="post-actions">
                                <a href="{{ route('profile.posts.edit', $post->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('profile.posts.delete', $post->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>No posts available.</p>
            @endif
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    </body>

</html>
