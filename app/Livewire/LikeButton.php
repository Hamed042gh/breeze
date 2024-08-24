<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LikeButton extends Component
{
    public Post $post;
    public int $likesCount = 0;
    public bool $isLiked = false;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->updateLikeStatus();
    }

    public function like()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $postKey = env('REDIS_POST_PREFIX', 'post_') . $this->post->id . ':' . env('REDIS_LIKE_PREFIX', 'likes');

        if (Redis::sismember($postKey, $userId)) {

            Redis::srem($postKey, $userId);
            Like::where('post_id', $this->post->id)
                ->where('user_id', $userId)
                ->delete();
        } else {
            // Add like
            Redis::sadd($postKey, $userId);
            Like::create(['post_id' => $this->post->id, 'user_id' => $userId]);
        }

        $this->updateLikeStatus();
        $this->dispatch('likeUpdated');
    }

    private function updateLikeStatus()
    {
        $postKey =env('REDIS_POST_PREFIX', 'post_') . $this->post->id . ':' . env('REDIS_LIKE_PREFIX', 'likes');
        $this->likesCount = Redis::scard($postKey);
        $this->isLiked = Auth::check() ? Redis::sismember($postKey, Auth::id()) : false;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
