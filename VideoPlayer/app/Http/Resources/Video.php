<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'contents' => $this->contents,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
