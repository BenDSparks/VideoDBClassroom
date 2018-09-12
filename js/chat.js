$(document).ready(function () {
    //start checkForMessage function when page is loaded
    setTimeout(checkForMessage, 500);
    setTimeout(checkForVideo, 500);
});

//this function loops checking 
function checkForMessage() {
    
    $.get("ajax/checkForMessageAjax.php",
            {},
    function (data, status) {
        if (data.length > 0) {
            var msglst = $("#msglist").html();
            
            msglst = msglst + "<br />" + data;
            
            $("#msglist").html(msglst);
        }
    });
    
    //loop function forever
    setTimeout(checkForMessage, 500);
}

function checkForVideo() {
    
    $.get("ajax/checkForVideoAjax.php",
            {},
    function (data, status) {
        if (data.length > 0) {
            //data is the video the student should be watching instead.
            //alert("video has been changed: " + data);
            //alertTest();
            loadRemoteVideo(data);
        }
    });
    
    
    setTimeout(checkForVideo, 500);
}

function sendMessage() {
    var msg = $("#mynewmsg").val();
    
    $("#mynewmsg").val("");
    
    $.get("ajax/addMessageAjax.php",
            {
                msg: msg
            },
    function (data, status) {
    });
}