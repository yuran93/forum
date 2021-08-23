<?php

namespace App\Providers;

use App\Repositories\Database\DatabaseCommentRepository;
use App\Repositories\Database\DatabasePostRepository;
use App\Repositories\Database\DatabaseUserRepository;
use App\Repositories\Contracts\CommentRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommentRepository::class, DatabaseCommentRepository::class);
        $this->app->bind(PostRepository::class, DatabasePostRepository::class);
        $this->app->bind(UserRepository::class, DatabaseUserRepository::class);
    }
}
