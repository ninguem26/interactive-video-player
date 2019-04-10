<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoContent;
use App\VideoMark;
use App\Http\Resources\VideoMark as VideoMarkResource;
use DateTime;

class VideoMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VideoMarkResource::collection(VideoMark::all());
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
        $content->options = json_encode($data['options']);
        $content->created_at = new DateTime;
        $content->updated_at = new DateTime;
        $content->save();

        $mark = new VideoMark;

        $mark->video_content_id = $content->id;
        $mark->title = $data['title'];
        $mark->created_at = new DateTime;
        $mark->updated_at = new DateTime;
        $mark->save();

        return response()->json(['message' => 'Marcação cadastrada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VideoMarkResource(VideoMark::find($id));
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

        $mark = VideoMark::find($id);

        $mark->title = $data['title'];
        $mark->updated_at = new DateTime;
        $mark->save();

        return response()->json(['message' => 'Marcação atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoMark::destroy($id);

        return response()->json(['message' => 'Marcação excluída']);
    }
}
