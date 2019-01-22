<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Interaction extends JsonResource
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
            'videoId' => $this->videoId,
            'type' => $this->type,
            'timeInSeconds' => $this->time,
            'timeString' => $this->getTimeString(),
            'createdAt' => $this->createdAt
        ];
    }
}
