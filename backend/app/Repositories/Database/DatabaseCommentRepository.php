<?php

namespace App\Repositories\Database;

use App\Repositories\Contracts\CommentRepository;
use Illuminate\Support\Arr;
use App\Models\Comment;

class DatabaseCommentRepository extends DatabaseBaseRepository implements CommentRepository
{
    /**
     * Construct the repository.
     *
     * @param \App\Models\Comment $model
     * @return void
     */
    public function __construct(Comment $model)
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

        if ( $postId = Arr::get($filters, 'post_id') ) {
            $query->where('post_id', $postId);
        }

        if ( $perPage )
            return $query->paginate($perPage);

        return $query->get();
    }
}
