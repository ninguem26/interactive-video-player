<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    protected $table = 'video_contents';

    public function data() {
        if($this->type == 'problem'){
            return $this->hasOne('App\VideoProblem');
        }elseif($this->type == 'anotation'){
            return $this->hasOne('App\Anotation');
        }elseif($this->type == 'mark'){
            return $this->hasOne('App\VideoMark');
        }
        return null;
    }

    public function video()
    {
        return $this->belongsTo('App\Video');
    }
}
