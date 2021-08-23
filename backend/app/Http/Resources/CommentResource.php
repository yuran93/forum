<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'body' => $this->resource->body,
            'time' => $this->resource->created_at->diffForHumans(),
            'user' => $this->resource->user->email,
        ];
    }
}
