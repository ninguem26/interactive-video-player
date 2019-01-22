<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $table = 'interactions';
    public $timestamps = false;

    public function getTimeString()
    {
        $seconds = $this->time;

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
