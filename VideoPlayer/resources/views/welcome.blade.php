<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vídeo Player</title>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
        <!-- Poppy.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <!-- Bootstrap.js -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <!-- Underscore -->
        <script src="{{ URL::asset('js/underscore.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/mediaelement/build/mediaelement-and-player.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/video.js') }}" type="text/javascript"></script>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mediaelementplayer.min.css') }}">
    </head>
    <body>
        <video id="my-video" width="600" height="480">
            <source src="{{ URL::asset('media/dora.mp4') }}" type="video/mp4">
            Não foi possível carregar o vídeo
        </video>
    </body>
</html>
