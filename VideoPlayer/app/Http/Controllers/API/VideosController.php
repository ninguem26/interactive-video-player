<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Http\Resources\Video as VideoResource;
use DB;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VideoResource::collection(Video::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;

        $video = new Video;

        $video->title = $data['title'];
        $video->url = $data['url'];
        $video->format = $data['format'];
        $video->duration = $data['duration'];
        $video->created_at = new DateTime;
        $video->updated_at = new DateTime;
        $video->save();

        return response()->json(['message'=> 'Vídeo salvo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VideoResource(Video::find($id));
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
        $data = $request->data;

        $video = Video::find($id);

        $video->title = $data['title'];
        $video->url = $data['url'];
        $video->format = $data['format'];
        $video->duration = $data['duration'];
        $video->updated_at = new DateTime;
        $video->save();

        return response()->json(['message'=> 'Vídeo atualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::destroy($id);

        return response()->json(['message' => 'Vídeo deletado']);
    }
}
