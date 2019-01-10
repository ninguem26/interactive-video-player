var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var player = videojs('my-video');
var interactionData = new Array();
var videoId = window.location.href.split("/")[4];
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

player.on('play', function() {
    var interactionData = setDataToSend("play");
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

player.on('fullscreenchange', function() {
    var interactionData = setDataToSend("fullscreenchange");
    submitToServer(interactionData);
});

/*player.on('click', function() {
    if(player.isFullscreen() != fullScreen) {
        fullScreen = player.isFullscreen();
        player.trigger('fullscreenchange');
    }
});*/

function setDataToSend(interactionType){
    return {videoId: videoId, type: interactionType, time: player.currentTime()};
}

function submitToServer(data){
    $.post('/interactions',
        {
            data: data,
            _token: CSRF_TOKEN
        },
        function(response){
            //console.log(response['message']);
        }
    );
}
