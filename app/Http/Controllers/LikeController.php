<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LikeController extends Controller
{

    public function toggleLike($postId)
    {
        $userId = Auth::id();
        $postKey = "post:{$postId}:likes";

        if ($this->isUserLikedPost($postKey, $userId)) {
            $this->removeLike($postKey, $postId, $userId);
        } else {
            $this->addLike($postKey, $postId, $userId);
        }

        return response()->json(['status' => 'success']);
    }

    private function isUserLikedPost($postKey, $userId)
    {
        return Redis::sismember($postKey, $userId);
    }

    private function removeLike($postKey, $postId, $userId)
    {
        Redis::srem($postKey, $userId);
        Like::where('post_id', $postId)->where('user_id', $userId)->delete();
    }

    private function addLike($postKey, $postId, $userId)
    {
        Redis::sadd($postKey, $userId);
        Like::create(['post_id' => $postId, 'user_id' => $userId]);
    }
}
