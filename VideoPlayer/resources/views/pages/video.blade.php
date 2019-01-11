@extends('layouts.default')

<head>
    <title>{{ $video->title }}</title>
</head>

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div>
                        <video id="my-video" class="video-js" data-setup='{"width": 720, "height": 480, "controls": true}'>
                            <source src="{{ URL::asset($video->url) }}" type='video/{{ $video->format }}'>
                            Não foi possível carregar o vídeo
                        </video>
                        <h5 class="card-title">{{ $video->title }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
