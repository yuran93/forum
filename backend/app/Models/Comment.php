<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'post_id',
    ];

    /**
     * Gets the related user.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the related post.
     *
     * @return \App\Models\Post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
