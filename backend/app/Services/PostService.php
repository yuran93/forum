<?php

namespace App\Services;

use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $repository;

    /**
     * Construct the service.
     *
     * @param \App\Repositories\Contracts\PostRepository $repository
     * @return void
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Gets my posts.
     *
     * @param string $search
     * @return \Illuminate\Support\Collection
     */
    public function getMyPosts($search = '')
    {
        return $this->repository->getFiltered([
            'user_id' => Auth::user()->id,
            'search' => $search,
        ]);
    }

    /**
     * Gets the pending posts.
     *
     * @param string $search
     * @return \Illuminate\Support\Collection
     */
    public function getPendingPosts($search = '')
    {
        return $this->repository->getFiltered([
            'approved' => 'pending',
            'search' => $search,
        ]);
    }

    /**
     * Gets the approved posts.
     *
     * @param string $search
     * @return \Illuminate\Support\Collection
     */
    public function getApprovedPosts($search = '')
    {
        return $this->repository->getFiltered([
            'approved' => 'approved',
            'search' => $search,
        ]);
    }
}
