<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
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
            'title' => $this->resource->title,
            'body' => $this->resource->body,
            'can_approve' => $this->resource->can_approve,
            'can_remove' => $this->resource->can_remove,
            'preview' => Str::limit($this->resource->body, 200),
            'datetime' => $this->resource->created_at->toDateTimeString(),
            'time' => $this->resource->created_at->diffForHumans(),
            'author' => $this->resource->user->email,
            'is_approved' => $this->resource->is_approved,
        ];
    }
}
