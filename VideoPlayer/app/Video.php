<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    public function contents()
    {
        return $this->hasMany('App\Content', 'videoId');
    }

    public function getDurationString()
    {
        $seconds = $this->duration;

        $hours = $seconds/3600;
        $minutes = ($hours - ((int) $hours)) * 60;
        $seconds = ($minutes - ((int) $minutes)) * 60;

        $timeString = "";
        if((int) $hours > 0){
            $timeString = (int) $hours . ":";
        }

        return $timeString . (int) $minutes . ":" . (int) $seconds;
    }
}
