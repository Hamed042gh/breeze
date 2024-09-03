<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class PostLiked  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $user;

    public function __construct($post, $user)
    {

        $this->post = $post;
        $this->user = $user;
    }

    //channel
    public function broadcastOn()
    {
        return new PrivateChannel('post.' . $this->post->id);
    }

    //event
    public function broadcastAs()
    {
        return 'PostLiked';
    }

    public function broadcastWith()
    {
        return [
            'post' => $this->post,
            'user' => $this->user

        ];
    }
}
