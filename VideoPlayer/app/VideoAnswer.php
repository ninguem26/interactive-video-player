<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoAnswer extends Model
{
    public function video_problem()
    {
        return $this->belongsTo('App\VideoProblem', 'video_problem_id');
    }
}
