<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\Log;
use App\Services\ApiResponse;

class ApprovePostController extends Controller
{
    /**
     * Approves the post.
     *
     * @param \App\Repositories\Contracts\PostRepository $repository
     * @param \App\Services\ApiResponse $response
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PostRepository $repository, ApiResponse $response, $id)
    {
        try {
            $repository->updateById($id, [
                'is_approved' => true,
            ]);
        }
        catch (\Exception $e) {
            Log::error('ApprovePostController: Unable to approve the record | ' . $e->getMessage());

            return $response->failed('Unable to update the post');
        }

        return $response->success('Successfully updated the post');
    }

}
