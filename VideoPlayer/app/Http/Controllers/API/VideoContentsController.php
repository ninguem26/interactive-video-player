<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoContent;
use App\Http\Resources\VideoContent as VideoContentResource;
use DateTime;

class VideoContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return VideoContentResource::collection(VideoContent::all());
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

        $content = new VideoContent;

        $content->video_id = $data['video_id'];
        $content->type = $data['type'];
        $content->options = $data['options'];
        $content->created_at = new DateTime;
        $content->updated_at = new DateTime;
        $content->save();

        return response()->json(['message' => 'Conteúdo salvo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VideoContentResource(VideoContent::find($id));
    }

    public function getByVideoId($videoId)
    {
        return VideoContentResource::collection(VideoContent::all()->where('video_id', $videoId));
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

        $content = VideoContent::find($id);

        $content->videoId = $data['videoId'];
        $content->type = $data['type'];
        $content->options = $data['options'];
        $content->updated_at = new DateTime;
        $content->save();

        return response()->json(['message' => 'Conteúdo atualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoContent::destroy($id);

        return response()->json(['message' => 'Conteúdo excluído']);
    }
}
