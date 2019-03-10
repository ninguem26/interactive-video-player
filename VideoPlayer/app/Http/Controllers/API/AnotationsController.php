<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoContent;
use App\Anotation;
use App\Http\Resources\Anotation as AnotationResource;
use DateTime;

class AnotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnotationResource::collection(Anotation::all());
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

        $anotation = new Anotation;

        $anotation->video_content_id = $content->id;
        $anotation->text = $data['text'];
        $anotation->created_at = new DateTime;
        $anotation->updated_at = new DateTime;
        $anotation->save();
        
        return response()->json(['message' => 'Anotação cadastrada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AnotationResource(Anotation::find($id));
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

        $anotation = new Anotation;

        $anotation->text = $data['text'];
        $anotation->updated_at = new DateTime;
        $anotation->save();

        return response()->json(['message' => 'Anotação atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anotation::destroy($id);

        return response()->json(['message' => 'Anotação excluída']);
    }
}
