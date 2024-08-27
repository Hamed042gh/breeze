<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Redis;

class OnlineUsers extends Component
{
    public function render()
    {
        $keys = Redis::keys('user_online_*');

       
        $onlineUserIds = [];
        foreach ($keys as $key) {
          
            $parts = explode('_', $key);
          
            $onlineUserIds[] = end($parts);
        }
    

        if (!empty($onlineUserIds)) {
            $onlineUsers = User::whereIn('id', $onlineUserIds)->get();
        } else {
            $onlineUsers = collect(); 
        }

        return view('livewire.online-users', compact('onlineUsers'));
    }
}
          