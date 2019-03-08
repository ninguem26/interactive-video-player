<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoProblem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $content = $this->video_content;

        return [
            'id' => $this->id,
            'video' => $content->video,
            'type' => $content->type,
            'options' => $content->options,
            'problem_type' => $this->type,
            'question' => $this->question,
            'alternatives' => $this->alternatives,
            'answers' => $this->answers,
            'createdAt' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
