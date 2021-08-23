<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class PendingPostsController extends Controller
{
    /**
     * Lets try to login to the system.
     *
     * @param \App\Services\PostService $postService
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PostService $postService, Request $request)
    {
        $posts = $postService->getPendingPosts($request->get('search'));

        return PostResource::collection($posts);
    }
}
