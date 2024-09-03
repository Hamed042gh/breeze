<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\NotifyPostCreated;


class SendPostCreatedNotification
{

    public function handle(PostCreated $event): void
    {
        NotifyPostCreated::dispatch($event->post);
    }
}
