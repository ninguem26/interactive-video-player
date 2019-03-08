//import 'mediaelement/full';

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var player = null;
var interactionData = new Array();
var videoId = 0;
var fullScreen = false;

/*
$.post('/instructionalDesign/definition/data',
        {
            resources: selectedResources,
            _token: '{{csrf_token()}}'
        },
        function(response){
            window.location.href = "/instructionalDesign/aplication";
        });
*/

player = new MediaElementPlayer('my-video', {
    pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
    shimScriptAccess: 'always',
    controlsEnabled: true,
    alwaysShowControls: true,
    success: function(mediaElement, originalNode, instance) {
        console.log(mediaElement);
    }
});

console.log(player);

function init(player_id, video_id) {
    player = new MediaElement('my-video', {
        pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
        shimScriptAccess: 'always',
        controlsEnabled: true,
        alwaysShowControls: true,
        success: function(mediaElement, originalNode, instance) {
            console.log(mediaElement);
        }
    });

    console.log(player);
    player.on('play', function() {
        console.log("PLAY");
    });
    /*
    videoId = video_id;

    player.on('play', function() {
        console.log("PLAY");
        var interactionData = setDataToSend("play");
        submitToServer(interactionData);
    });

    player.on('pause', function() {
        console.log("PAUSE");
        var interactionData = setDataToSend("pause");
        submitToServer(interactionData);
    });

    player.on('seeked', function() {
        var interactionData = setDataToSend("seek");
        submitToServer(interactionData);
    });

    player.on('volumechange', function() {
        var interactionData = setDataToSend("volumeChange");
        submitToServer(interactionData);
    });

    player.on('ended', function() {
        var interactionData = setDataToSend("ended");
        submitToServer(interactionData);
    });

    player.on('fullscreenchange', function() {
        var interactionData = setDataToSend("fullscreenchange");
        submitToServer(interactionData);
    });
    */
}

/*player.on('click', function() {
    if(player.isFullscreen() != fullScreen) {
        fullScreen = player.isFullscreen();
        player.trigger('fullscreenchange');
    }
});*/

function setDataToSend(interactionType){
    return {
        videoId: videoId,
        type: interactionType,
        time: player.currentTime()
    };
}

function submitToServer(data){
    $.post('/api/interactions',
        {
            data: data,
            _token: CSRF_TOKEN
        },
        function(response){
            //console.log(response['message']);
        }
    );
}
