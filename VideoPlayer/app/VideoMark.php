<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoMark extends Model
{
    public function video_content()
    {
        return $this->belongsTo('App\VideoContent', 'video_content_id');
    }
}
