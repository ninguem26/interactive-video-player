<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Content;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        foreach($videos as $v){
            $v->durationString = $this->secondsToTime($v->duration);
        }

        return view('pages/videos/index')->with(['videos' => $videos]);
    }

    public function secondsToTime($seconds)
    {
        $hours = $seconds/3600;
        $minutes = ($hours - ((int) $hours)) * 60;
        $seconds = ($minutes - ((int) $minutes)) * 60;

        $timeString = "";
        if((int) $hours > 0){
            $timeString = (int) $hours . ":";
        }

        return $timeString . (int) $minutes . ":" . (int) $seconds;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);

        return view('pages/videos/show')->with(['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);

        return view('pages/videos/edit')->with(['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
