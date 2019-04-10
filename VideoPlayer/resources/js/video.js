import Plyr from "plyr";
//let videojs = require("./video.min.js");

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
export var player = null;
var elem = null;
var interactionData = new Array();
var videoId = 0;
var sessionId = 0;
var fullScreen = false;
var mousePos = {x: 0, y: 0};
var ended = false;

export function init(playerId, receivedVideoId, receivedSessionId) {
    player = new Plyr(playerId, {
        fullscreen: {
            enabled: false
        }
    });
    videoId = receivedVideoId;
    sessionId = receivedSessionId;

    elem = document.getElementById("canvas");
    elem.onmousemove = findObjectCoords;

    player.on('play', function() {
        var data = { mousePos: { x: mousePos.x, y: mousePos.y } };
        var interaction = "play";
        if(ended) {
            interaction = "replay";
            ended = false;
        }

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    player.on('click', function(e) {
        mousePos.x = e.clientX;
        mousePos.y = e.clientY;
        var interactionData = setDataToSend("click", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('pause', function() {
        var interactionData = setDataToSend("pause", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('seeked', function() {
        var interactionData = setDataToSend("seek", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('volumechange', function() {
        var interactionData = setDataToSend("volumeChange", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('ended', function() {
        ended = true;

        var interactionData = setDataToSend("ended", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('enterfullscreen', function() {
        var interactionData = setDataToSend("enterfullscreen", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('exitfullscreen', function() {
        var interactionData = setDataToSend("exitfullscreen", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('captionsenabled', function() {
        var interactionData = setDataToSend("captionsenabled", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('captionsdisabled', function() {
        var interactionData = setDataToSend("captionsdisabled", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    player.on('languagechange', function(e) {
        var interactionData = setDataToSend("languagechange", {
            language: e.detail.plyr.captions.language,
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    document.addEventListener('alternativeselected', function(e) {
        var interactionData = setDataToSend("alternativeselected", {
            aleternative:e.detail.alternative,
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    document.addEventListener('submitanswer', function() {
        var interactionData = setDataToSend("submitanswer", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    document.addEventListener('skipquestion', function() {
        var interactionData = setDataToSend("skipquestion", {
            mousePos: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
        submitToServer(interactionData);
    });

    document.addEventListener('visibilitychange', function() {
        var data = { playing: player.playing };
        var interaction = "exitpage";
        if(document.visibilityState == 'visible') {
            interaction = "enterpage";
        }

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    document.addEventListener('showanotation', function() {
        var data = { mousePos: { x: mousePos.x, y: mousePos.y } };
        var interaction = "showanotation";

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    document.addEventListener('hideanotation', function() {
        var data = { mousePos: { x: mousePos.x, y: mousePos.y } };
        var interaction = "hideanotation";

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    document.addEventListener('dismissanotation', function(e) {
        var data = {
            content_id: e.detail.content_id,
            anotation_id: e.detail.anotation_id,
            mousePos: { x: mousePos.x, y: mousePos.y }
        };
        var interaction = "dismissanotation";

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    document.addEventListener('entermark', function(e) {
        var data = {
            video_mark_id: e.detail.video_mark_id,
            mousePos: { x: mousePos.x, y: mousePos.y }
        };
        var interaction = "entermark";

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });

    document.addEventListener('jumptomark', function(e) {
        var data = {
            video_mark_id: e.detail.video_mark_id,
            mousePos: { x: mousePos.x, y: mousePos.y }
        };
        var interaction = "jumptomark";

        var interactionData = setDataToSend(interaction, data);
        submitToServer(interactionData);
    });
}

function findObjectCoords(mouseEvent)
{
    var obj = document.getElementById("canvas");
    var obj_left = 0;
    var obj_top = 0;
    var xpos;
    var ypos;

    while(obj.offsetParent) {
        obj_left += obj.offsetLeft;
        obj_top += obj.offsetTop;
        obj = obj.offsetParent;
    }
    if(mouseEvent) {
        xpos = mouseEvent.pageX;
        ypos = mouseEvent.pageY;
    } else {
        xpos = window.event.x + document.body.scrollLeft - 2;
        ypos = window.event.y + document.body.scrollTop - 2;
    }
    xpos -= obj_left;
    ypos -= obj_top;
    mousePos = {
        x: xpos,
        y: ypos
    }
}

function setDataToSend(interactionType, eventData){
    return {
        sessionId: sessionId,
        videoId: videoId,
        type: interactionType,
        time: player.currentTime,
        data: eventData
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
