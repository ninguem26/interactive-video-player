<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interaction;
use App\Http\Resources\Interaction as InteractionResource;
use DateTime;

class InteractionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InteractionResource::collection(Interaction::all());
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

        $interaction = new Interaction;

        $interaction->video_id = $data['videoId'];
        $interaction->type = $data['type'];
        $interaction->time = $data['time'];
        $interaction->created_at = new DateTime;
        $interaction->updated_at = new DateTime;
        $interaction->save();

        return response()->json(['message' => 'Interação salva']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new InteractionResource(Interaction::find($id));
    }

    public function getByVideoId($videoId)
    {
        return InteractionResource::collection(Interaction::all()->where('videoId', $videoId));
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

        $interaction = Interaction::find($id);

        $interaction->videoId = $data['videoId'];
        $interaction->type = $data['type'];
        $interaction->time = $data['time'];
        $interaction->save();

        return response()->json(['message' => 'Interação atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Interaction::destroy($id);

        return response()->json(['message' => 'Interação excluída']);
    }
}
