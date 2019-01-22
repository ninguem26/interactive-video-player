<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Content as ContentResource;

class Video extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'format' => $this->format,
            'durationInSeconds' => $this->duration,
            'durationString' => $this->getDurationString(),
            'contents' => ContentResource::collection($this->contents),
            'createdAt' => $this->created_at
        ];
    }
}
