<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CommentRepository;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $repository;
    protected $response;

    /**
     * Construct the resource.
     *
     * @param \App\Repositories\Contracts\CommentRepository $repository
     * @param \App\Services\ApiResponse $response
     */
    public function __construct(CommentRepository $repository, ApiResponse $response)
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
        $comments = $this->repository->getFiltered([
            'post_id' => $request->get('post_id'),
        ]);

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try {
            $data = $request->input();

            $data['user_id'] = Auth::user()->id;

            $comment = $this->repository->create($data);

            return $this->response->success($comment);

        } catch (\Exception $e) {

            Log::error('CommentsController(store): Unable to create the record | ' . $e->getMessage());

            return $this->response->failed('Unable to add a comment.');
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
        $comment = $this->repository->find($id);

        return new CommentResource($comment);
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
        //
    }
}
