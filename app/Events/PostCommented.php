<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCommented  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $comment;
    public $user;
    public function __construct($post, $user, $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->user = $user;
    }

    public function broadcastOn()
    {

        return new Channel('post.' . $this->post->id);
    }

    public function broadcastWith()
    {
        return
            [
                'post' => $this->post->toArray(),
                'user' => $this->user->toArray(),
                'comment' => $this->comment->toArray()

            ];
    }
}
