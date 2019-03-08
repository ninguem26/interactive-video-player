<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoContent extends JsonResource
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
            'video' => $this->video,
            'type' => $this->type,
            'options' => $this->options,
            'data' => $this->data,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
