<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';

    public function video()
    {
        return $this->belongsTo('App\Video', 'videoId');
    }
}
