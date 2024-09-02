<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post.{postId}', function ($user,$postId) {
    return Auth::check() && $user->id == Post::find($postId)->user_id;
});
