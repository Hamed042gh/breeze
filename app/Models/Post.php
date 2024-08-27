<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Post extends Model
{
    use HasFactory;
    use Commentable;

    protected $fillable = ['title', 'body', 'user_id'];

    // If you want to use timestamps, you can enable them here
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }



    public function isLikedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    
    public function toggleLike(User $user)
    {
        if ($this->isLikedBy($user)) {
            $this->likes()->where('user_id', $user->id)->delete();
        } else {
            $this->likes()->create(['user_id' => $user->id]);
        }
    }
}
