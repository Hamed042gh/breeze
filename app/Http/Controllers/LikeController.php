<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LikeController extends Controller
{
    /**
     * Toggle like status for a post.
     */
    public function toggleLike($postId)
    {
        $userId = Auth::id();
        $postKey = "post:{$postId}:likes";

        if (Redis::sismember($postKey, $userId)) {
            // Remove like
            Redis::srem($postKey, $userId);
            Like::where('post_id', $postId)->where('user_id', $userId)->delete();
        } else {
            // Add like
            Redis::sadd($postKey, $userId);
            Like::create(['post_id' => $postId, 'user_id' => $userId]);
        }

        // Optionally emit an event or return a response
        return response()->json(['status' => 'success']);
    }
}
