<?php

namespace App\Livewire;

use App\Events\PostLiked;
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
        $this->validatePost();
        $this->updateLikeStatus();
    }

    public function like()
    {
        if (!$this->isUserAuthenticated()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $postKey = $this->getRedisPostKey();

        if ($this->isPostLikedByUser($postKey, $userId)) {
            $this->removeLike($postKey, $userId);
        } else {
            $this->addLike($postKey, $userId);
            broadcast(new PostLiked($this->post, Auth::user()));
        }

        $this->updateLikeStatus();
        $this->dispatch('likeUpdated');
    }

    private function validatePost()
    {
        if (!$this->post) {
            throw new \Exception('Invalid post.');
        }
    }

    private function isUserAuthenticated()
    {
        return Auth::check();
    }

    private function getRedisPostKey()
    {
        return env('REDIS_POST_PREFIX', 'post_') . $this->post->id . ':' . env('REDIS_LIKE_PREFIX', 'likes');
    }

    private function isPostLikedByUser($postKey, $userId)
    {
        return Redis::sismember($postKey, $userId);
    }

    private function addLike($postKey, $userId)
    {
        Redis::sadd($postKey, $userId);
        Like::create(['post_id' => $this->post->id, 'user_id' => $userId]);
    }

    private function removeLike($postKey, $userId)
    {
        Redis::srem($postKey, $userId);
        Like::where('post_id', $this->post->id)
            ->where('user_id', $userId)
            ->delete();
    }

    private function updateLikeStatus()
    {
        $postKey = $this->getRedisPostKey();
        $this->likesCount = Redis::scard($postKey);
        $this->isLiked = $this->isUserAuthenticated() ? $this->isPostLikedByUser($postKey, Auth::id()) : false;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
