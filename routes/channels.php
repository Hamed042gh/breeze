<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post', function () {
    return true;
});
