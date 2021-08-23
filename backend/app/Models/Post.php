<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'is_approved',
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
     * Gets the related comments.
     *
     * @return \Illuminate\Support\Collection
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Gets whether we can approve the post or not.
     *
     * @return boolean
     */
    public function getCanApproveAttribute()
    {
        return Auth::user()->is_admin ? !$this->is_approved : false;
    }

    /**
     * Gets if user can delete the post or not.
     *
     * @return boolean
     */
    public function getCanRemoveAttribute()
    {
        return Auth::user()->id == $this->user_id ? true : Auth::user()->is_admin;
    }
}
