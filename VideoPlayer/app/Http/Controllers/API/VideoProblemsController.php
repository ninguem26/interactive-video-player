<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoContent;
use App\VideoProblem;
use App\Http\Resources\VideoProblem as VideoProblemResource;
use DateTime;

class VideoProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VideoProblemResource::collection(VideoProblem::all());
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

        $problem = new VideoProblem;

        $problem->video_content_id = $content->id;
        $problem->type = $data['problem_type'];
        $problem->question = $data['question'];
        $problem->alternatives = json_encode($data['alternatives']);
        $problem->answers = json_encode($data['answers']);
        $problem->created_at = new DateTime;
        $problem->updated_at = new DateTime;
        $problem->save();

        return response()->json(['message' => 'Problema cadastrado', 'data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VideoProblemResource(Problem::find($id));
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

        $problem = new VideoProblem;

        $problem->question = $data['question'];
        $problem->alternatives = $data['alternatives'];
        $problem->answers = $data['answers'];
        $content->updated_at = new DateTime;
        $problem->save();

        return response()->json(['message' => 'Problema atualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoProblem::destroy($id);

        return response()->json(['message' => 'Problema excluído']);
    }
}
