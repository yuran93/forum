<?php

namespace App\Repositories\Database;

use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Arr;
use App\Models\Post;

class DatabasePostRepository extends DatabaseBaseRepository implements PostRepository
{
    /**
     * Construct the repository.
     *
     * @param \App\Models\Post $model
     * @return void
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Find all items.
     *
     * @param array $filters
     * @param mixed $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFiltered($filters = [], $perPage = null)
    {
        $query = $this->model->newQuery();

        if ( $userId = Arr::get($filters, 'user_id') ) {
            $query->where('user_id', $userId);
        }

        if ( $approved = Arr::get($filters, 'approved') ) {
            $query->where('is_approved', $approved == 'approved');
        }

        if ( $search = Arr::get($filters, 'search') ) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query = $query->latest();

        if ( $perPage )
            return $query->paginate($perPage);

        return $query->get();
    }
}
