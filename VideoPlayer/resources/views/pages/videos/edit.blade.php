@extends('layouts.default')

<head>
    <title>{{ $video->title }}</title>
</head>

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="wrapper col-12">
                        <video id="my-video" class="video-js vjs-16-9 vjs-big-play-centered" data-setup='{"width": 720, "height": 480, "controls": true}'>
                            <source src="{{ URL::asset($video->url) }}" type='video/{{ $video->format }}'>
                            Não foi possível carregar o vídeo
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
