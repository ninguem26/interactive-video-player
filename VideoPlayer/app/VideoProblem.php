<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoProblem extends Model
{
    protected $table = 'video_problems';

    public function video_content()
    {
        return $this->belongsTo('App\VideoContent', 'video_content_id');
    }

    public function video_answers()
    {
        return $this->hasMany('App\VideoAnswer', 'video_problem_id');
    }
}
