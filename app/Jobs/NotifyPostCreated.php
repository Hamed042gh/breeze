<?php

namespace App\Jobs;

use App\Mail\PostCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyPostCreated implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels, Dispatchable;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }


    public function handle(): void
    {
        Mail::to('hello@example.com')->send(new PostCreatedMail($this->post));
    }
}
