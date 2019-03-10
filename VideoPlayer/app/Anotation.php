<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotation extends Model
{
    public function video_content()
    {
        return $this->belongsTo('App\VideoContent', 'video_content_id');
    }
}
