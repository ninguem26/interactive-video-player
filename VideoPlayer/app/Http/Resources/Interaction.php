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
            'video_id' => $this->video_id,
            'type' => $this->type,
            'data' => $this->data,
            'timeInSeconds' => $this->time,
            'timeString' => $this->getTimeString(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
