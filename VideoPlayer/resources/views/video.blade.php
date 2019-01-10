<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">

        <!-- Underscore -->
        <script src="{{ URL::asset('js/underscore.js') }}" type="text/javascript"></script>

        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

        <title>Video</title>
    </head>
    <body>
        <video id="my-video" class="video-js" data-setup='{"width": 640, "height": 264, "controls": true}'>
            <source src="{{ URL::asset($video->url) }}" type='video/{{ $video->format }}'>
            Não foi possível carregar o vídeo
        </video>

        <script src="https://vjs.zencdn.net/7.4.1/video.js" type="text/javascript"></script>
        <script src="{{ URL::asset('js/video.js') }}" type="text/javascript"></script>
    </body>
</html>
