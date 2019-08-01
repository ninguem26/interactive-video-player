<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Http\Resources\Video as VideoResource;
use DateTime;
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

    public function generateDashboard($id)
    {
        $video = Video::find($id);

        $interactions = $video->interactions->where('created_at', '>=', '2019-04-24 17:45:00');
        $contents = $video->contents;

        $problems = $contents->where('type', 'problem');
        $marks = $contents->where('type', 'mark');

        $interactionsByType = $this->qntInteractionsByType($id);
        $problemsData = $this->problemsData($problems);
        $interactionsByTime = $this->interactionsByTime($interactions, $video->duration, 5);
        $qntViewsBySection = $this->qntViewsBySection($marks, $interactions->where('type', 'entermark'));

        return response()->json([
            'interactionsByType' => $interactionsByType,
            'problemsData' => $problemsData,
            'interactionsByTime' => $interactionsByTime,
            'viewsBySection' => $qntViewsBySection
        ]);
    }

    function qntInteractionsByType($id)
    {
        $labels = array();
        $data = array();

        $interactions =  DB::table('interactions')
            ->select('type', DB::raw('count(*) as total'))
            ->where('video_id', $id)
            ->where('created_at', '>=', '2019-04-24 17:45:00')
            ->groupBy('type')
            ->orderBy('total', 'desc')
            ->get();

        foreach ($interactions as $i) {
            if($i->type == 'play') {
                array_push($labels, "Play");
                array_push($data, $i->total);
            }
            if($i->type == 'pause') {
                array_push($labels, "Pause");
                array_push($data, $i->total);
            }
            if($i->type == 'click') {
                array_push($labels, "Click");
                array_push($data, $i->total);
            }
            if($i->type == 'seek') {
                array_push($labels, "Seek");
                array_push($data, $i->total);
            }
            if($i->type == 'volumechange') {
                array_push($labels, "Volume Change");
                array_push($data, $i->total);
            }
            if($i->type == 'ended') {
                array_push($labels, "Ended");
                array_push($data, $i->total);
            }
            if($i->type == 'enterfullscreen') {
                array_push($labels, "Enter Full Screen");
                array_push($data, $i->total);
            }
            if($i->type == 'exitfullscreen') {
                array_push($labels, "Exit Full Screen");
                array_push($data, $i->total);
            }
            if($i->type == 'captionsenabled') {
                array_push($labels, "Captions Enabled");
                array_push($data, $i->total);
            }
            if($i->type == 'captionsdisabled') {
                array_push($labels, "Captions Disabled");
                array_push($data, $i->total);
            }
            if($i->type == 'languagecange') {
                array_push($labels, "Language Change");
                array_push($data, $i->total);
            }
            if($i->type == 'alternativeselected') {
                array_push($labels, "Alternative Selected");
                array_push($data, $i->total);
            }
            if($i->type == 'submitanswer') {
                array_push($labels, "Submit Answer");
                array_push($data, $i->total);
            }
            if($i->type == 'skipquestion') {
                array_push($labels, "Skip Question");
                array_push($data, $i->total);
            }
            if($i->type == 'exitpage') {
                array_push($labels, "Exit Page");
                array_push($data, $i->total);
            }
            if($i->type == 'enterpage') {
                array_push($labels, "Enter Page");
                array_push($data, $i->total);
            }
            if($i->type == 'showanotation') {
                array_push($labels, "Show Anotation");
                array_push($data, $i->total);
            }
            if($i->type == 'hideanotation') {
                array_push($labels, "Hide Anotation");
                array_push($data, $i->total);
            }
            if($i->type == 'dismissanotation') {
                array_push($labels, "Dismiss Anotation");
                array_push($data, $i->total);
            }
            if($i->type == 'entermark') {
                array_push($labels, "Enter Mark");
                array_push($data, $i->total);
            }
            if($i->type == 'jumptomark') {
                array_push($labels, "Jump To Mark");
                array_push($data, $i->total);
            }
        }

        return ['labels' => $labels, 'data' => $data];
    }

    function problemsData($problems) {
        $results = array();

        foreach($problems as $problem) {
            $data = $problem->data;
            $answers = $data->video_answers->where('created_at', '>=', '2019-04-24 17:45:00');
            $corrects = 0;
            $qnt_selected_alternatives = array_fill(0, count(json_decode($data->alternatives)), 0);
            $alternativesLabel = array();

            foreach($answers as $answer) {
                if($answer->is_correct) {
                    $corrects++;
                }
                $qnt_selected_alternatives[json_decode($answer->answer)->selected - 1]++;
            }

            for($i = 0; $i < count(json_decode($data->alternatives)); $i++) {
                array_push($alternativesLabel, "Alternativa " . ($i + 1));
            }
            $data_pack = ['problem' => $data, 'totalAnswers' => count($answers), 'correctAnswers' => $corrects, 'alternativesLabel' => $alternativesLabel, 'qntSelectedAnswers' => $qnt_selected_alternatives];
            array_push($results, $data_pack);
        }
        return $results;
    }

    function interactionsByTime($interactions, $video_length, $interval) {
        $labels = array();
        $values = array();

        for($i = 0; $i < $video_length; $i = $i + $interval) {
            $j = $i + $interval;
            if($j >= $video_length) {
                $j = $video_length;
            } else {
                $j = $j - 1;
            }
            array_push($labels, $i . '-' . ($j));
            array_push($values, $interactions->whereBetween('time',[$i, $j])->count());
        }
        return ['labels' => $labels, 'data' => $values];
    }

    function qntViewsBySection($marks, $interactions) {
        $labels = array();
        $values = array();

        foreach($marks as $mark) {
            $views = 0;
            array_push($labels, $mark->data->title);

            foreach($interactions as $i) {
                if(json_decode($i->data)->video_mark_id == $mark->data->id) {
                    $views++;
                }
            }
            array_push($values, $views);
        }
        return ['labels' => $labels, 'data' => $values];
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
