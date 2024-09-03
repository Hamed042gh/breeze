<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post.{postId}', function ($user, $postId) {
    $post = Post::find($postId);

    if (!$post) {
        return false;
    }

    return Auth::check() && $user->id === $post->user_id;
});
