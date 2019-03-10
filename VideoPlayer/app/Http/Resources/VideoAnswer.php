<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoAnswer extends JsonResource
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
            'problem' => $this->video_problem,
            'answer' => $this->answer,
            'expected_answer' => $this->expected_answer,
            'is_correct' => $this->is_correct,
            'createdAt' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
