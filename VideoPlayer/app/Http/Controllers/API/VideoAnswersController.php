<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoAnswer;
use App\Http\Resources\VideoAnswer as VideoAnswerResource;
use DateTime;

class VideoAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VideoAnswerResource::collection(VideoAnswer::all());
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

        $answer = new VideoAnswer;

        $answer->video_problem_id = $data['video_problem_id'];
        $answer->answer = json_encode($data['answer']);
        $answer->expected_answer = json_encode($data['expected_answer']);
        $answer->is_correct = $data['is_correct'];
        $answer->created_at = new DateTime;
        $answer->updated_at = new DateTime;
        $answer->save();

        return response()->json(['message' => 'Resposta cadastrada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VideoAnswerResource(VideoAnswer::find($id));
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
        $data = $request->data();

        $answer = VideoAnswer::find($id);

        $answer->answer = json_encode($data['answer']);
        $answer->expected_answer = json_encode($data['expected_answer']);
        $answer->is_correct = $data['is_correct'];
        $answer->updated_at = new DateTime;
        $answer->save();

        return response()->json(['message' => 'Resposta atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoAnswer::destroy($id);

        return response()->json(['message' => 'Resposta excluída']);
    }
}
