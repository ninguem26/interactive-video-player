import Plyr from "plyr";
//let videojs = require("./video.min.js");

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
export var player = null;
var elem = null;
var interactionData = new Array();
var videoId = 0;
var fullScreen = false;

export function init(playerId, receivedVideoId) {
    player = new Plyr(playerId);
    videoId = receivedVideoId;

    elem = document.getElementById("canvas");

    player.on('play', function() {
        var interactionData = setDataToSend("play");
        submitToServer(interactionData);
    });

    player.on('click', function() {
        var interactionData = setDataToSend("click");
        submitToServer(interactionData);
    });

    player.on('pause', function() {
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

    player.on('enterfullscreen', function() {

        var interactionData = setDataToSend("enterfullscreen");
        submitToServer(interactionData);
    });

    player.on('exitfullscreen', function() {
        var interactionData = setDataToSend("exitfullscreen");
        submitToServer(interactionData);
    });
}

function setDataToSend(interactionType){
    return {
        videoId: videoId,
        type: interactionType,
        time: player.currentTime
    };
}

function submitToServer(data){
    $.post('/api/interactions',
        {
            data: data,
            _token: CSRF_TOKEN
        },
        function(response){}
    );
}
