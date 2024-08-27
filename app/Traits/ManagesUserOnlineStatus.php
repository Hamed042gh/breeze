<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

trait ManagesUserOnlineStatus
{
    private function setUserOnlineStatus($userId): void
    {
        $key = 'user_online_' . $userId;
        Redis::set($key, true);
        Redis::expire($key, 300);
        Log::info('Set user online status', ['key' => $key, 'value' => Redis::get($key)]);
    }

    protected function removeUserOnlineStatus($userId): void
    {
        $key = 'user_online_' . $userId;
        Redis::del($key);
        Log::info('Removed user online status', ['key' => $key]);
    }
}
