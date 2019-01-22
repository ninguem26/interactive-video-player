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
                        <div class="row">
                            <div class="col-8">
                                <video id="my-video" class="video-js vjs-16-9 vjs-big-play-centered" data-setup='{"width": 720, "height": 480, "controls": true}'>
                                    <source src="{{ URL::asset($video->url) }}" type='video/{{ $video->format }}'>
                                    Não foi possível carregar o vídeo
                                </video>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-dark">
                                    <div class="card-header">Sessões</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Dark card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div><h5 class="card-title">{{ $video->title }}</h5></div>
                        <a class="btn btn-warning btn-block" href="/videos/{{ $video->id }}/edit" role="button">Editar vídeo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
