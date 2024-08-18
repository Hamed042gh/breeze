<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body','user_id'];

    // If you want to use timestamps, you can enable them here
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
