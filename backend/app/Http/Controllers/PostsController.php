<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostRequest;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $repository;
    protected $response;

    /**
     * Construct the resource.
     *
     * @param \App\Repositories\Contracts\PostRepository $repository
     * @param \App\Services\ApiResponse $response
     */
    public function __construct(PostRepository $repository, ApiResponse $response)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->repository->getFiltered([
            'search' => $request->get('search'),
        ]);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {

            $data = $request->input();

            $data['user_id'] = Auth::user()->id;
            $data['is_approved'] = Auth::user()->is_admin;

            $post = $this->repository->create($data);

            return $this->response->success($post);

        } catch (\Exception $e) {

            Log::error('PostController(store): Unable to create the record | ' . $e->getMessage());

            return $this->response->failed('Unable to create the post.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->find($id);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $this->repository->deleteById($id);

            return $this->response->success('Successfully deleted the post');

        }
        catch (\Exception $e) {

            Log::error('PostsController(destroy): Unable to delete the record | ' . $e->getMessage());

            return $this->response->failed('Unable to delete the post');

        }
    }
}
