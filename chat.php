<?php

session_start();

// ----------Database Connection ----------
include_once("dbconn/MySQLconn.php");
// ----------------End---------------------

include_once("dao/CHmessageDao.class.php");
$chmsgdao = new CHmessageDao();

include_once("dao/CHmsg_countDao.class.php");
$chmsgcntdao = new CHmsg_countDao();

include_once("dao/CHuser_countDao.class.php");
$chusrcntdao = new CHuser_countDao();

include_once("dao/MyDao.class.php");
$myDao = new MyDao();

include_once("dao/MyVideoDao.class.php");
$myVideoDao = new MyVideoDao();

if (isset($_SESSION['myusernum'])) {
    //if already in the session
    $myusn = intval($_SESSION['myusernum']);
} else {
    //if not already in session
    
    //add user to database
    $chusrcntdao->addUserCount($conn);
    //get the last ID added because it was you and set it to the session myusernum
    $myusn = $chusrcntdao->getMaxId($conn);
    $_SESSION['myusernum'] = $myusn;
    
    //count all of the messages that have been sent in the chat
    $totalmsgcnt = $chmsgdao->countAllMessages($conn);
    
    //set users message count to total message count
    $chmsgcntdao->addMsgCount($conn, $myusn, $totalmsgcnt);
}

$vidArr = array();
$ytIdArr = array();
$descArray = array();

//$query = "SELECT vid, youtube_id, title FROM video";
//$result = mysqli_query($conn, $query);
//
//if ($result) {
//    //echo "found results in video query";
//    while ($row = mysqli_fetch_assoc($result)) {
//        $vidArr[] = $row['vid'];
//        $ytIdArr[] = $row['youtube_id'];
//        $titleArray[] = $row['title'];
//    }
//}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User <?php print $myusn; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/chat.js"></script>
        
        
    
    
    </head>
    
   <script>
        var xmlhttp;

        function loadXMLDoc(url, cfunc) { // Connection using ajax
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = cfunc;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }

        function loadRemoteVideo(v) {
            
            
            var myurl = "ajax/loadRemoteVideo.php?id=" + v + "&myusn=" + <?php print $myusn ?>;

            loadXMLDoc(myurl, function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    result = xmlhttp.responseText;

                    if (result.length > 0) {
                        //alert("result: " + result);
                        player.loadVideoById(result);
                    }
                }
            });
        }
        
        function alertTest(){
            //alert("Alert test");
        }
        
        function goToPlace(u, v) {
            var dur = (v + 1) * 1000;
            player.playVideo();
            player.seekTo(u, true);
            setTimeout(pauseVideo, dur);
        }
    </script>
    
    <body>
        <?php
            if (isset($_GET{'buttonChoice'})){
                $buttonChoice = $_GET{'buttonChoice'};
                //echo "buttonChoice set";

                if (strcmp($buttonChoice, "instructor") == 0){
                    //echo "picked instructor";
                    if ($myDao->checkInstructor($conn)){
                         //instructor not picked yet. set this person as instructor
                        //echo "Setting instructor for number " . $myusn;
                        $myDao->setInstructor($conn, $myusn);
                       // $myVideoDao->setVideoWatching($conn, $myusn);
                        echo "You are now the instructor.";
                        $isIntructor = 1;
                        
                    }
                    else{
                        if ($myDao->amITheInstructor($conn, $myusn)){
                            echo "Instructor resigning in.";
                            $isIntructor = 1;
                        }
                        else{
                            //instructor already picked. diplsayer error message at top
                            echo "An instructor already exists. You have been set to student.";
                            $isIntructor = 0;
                        }
                    }


                }
                else if (strcmp($buttonChoice, "student") == 0){

                    if ($myDao->amITheInstructor($conn, $myusn)){
                    echo "Instructor resigning in";
                    $isIntructor = 1;
                }
                else{
                    //picked student and is not the instructor
                    $isIntructor = 0;
                }

                }
            }
            else{
                //got to page without buttonChoice
                
                //check if this person is the instructor
                if ($myDao->amITheInstructor($conn, $myusn)){
                    echo "Instructor resigning in";
                    $isIntructor = 1;
                }
                else{
                    $isIntructor = 0;
                }
            } 
            
            
            
        ?>

        <br>
        <div id="player"></div>
        <br>

        <?php


        if ($isIntructor){
            ?>
        <form action="chat.php" method="post">
            Add youTube video to database <br>
            Title <input type="text" name="youtubetitle"> https://www.youtube.com/watch?v=<input type="text" name="youtubeid">
            <input type="submit" value="Add">
            <br>
        </form> 




        <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                 if (isset($_POST{'youtubeid'})){

                     if (isset($_POST{'youtubetitle'})){
                         $youTubeTitle = $_POST{'youtubetitle'};
                         $youTubeId = $_POST{'youtubeid'};
                         if (empty($youTubeTitle) || empty($youTubeId)){
                             echo "The title and youTube Id are required fields<br>";
                         }
                         else{
                            $myDao->addVideo($conn, $youTubeTitle, $youTubeId);
                            echo "Added video \"" . $youTubeTitle . "\" with v=" . $youTubeId;
                            echo "<br>";


                            //refresh video arrays



                         }

                    }
                 }

            }

            //get list of all videos
            $query = "SELECT vid, youtube_id, title FROM video";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $vidArr[] = $row['vid'];
                    $ytIdArr[] = $row['youtube_id'];
                    $titleArray[] = $row['title'];
                }
            }

            for ($i = 0; $i < count($vidArr); $i++) {
                //print $vidArr[$i];
                ?>
                <input class="wd1" type="button" onclick="loadRemoteVideo(<?php print $vidArr[$i]-1 ?>,<?php print $myusn ?>)" value="<?php print $titleArray[$i]; ?>" />
                <?php
            }
        }
        else{
            //get list of all videos
            $query = "SELECT vid, youtube_id, title FROM video";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $vidArr[] = $row['vid'];
                    $ytIdArr[] = $row['youtube_id'];
                    $titleArray[] = $row['title'];
                }
            }
        }


        ?>
        <br>
        <table>
            <tr>
                <td style="text-align:center"><b>User <?php print $myusn; ?></b></td>
            </tr>
            <tr>
                <td>
                    <textarea id="mynewmsg" rows="3" cols="60"></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align:center"><input type="button" onclick="sendMessage()" value="Send"/></td>
            </tr>
        </table>
        <p></p>
        <b>Message List:</b>
        <p></p>
        <div id="msglist" style="width:100%;height:25em;border:1px solid lightblue;overflow:scroll">

        </div>

        
        
        <?php 
            $currentVideo = $myVideoDao->getInstructorVideo($conn);
            //echo "Current video v=" . $ytIdArr[0] . " " . $currentVideo;
            //print "video number: " . $currentVideo;
            if ($currentVideo == ''){
                $ytid = "Ex4LWxxWe9I";
            }
            else{
                $ytid = $ytIdArr[ $currentVideo ];
            }
            
            
            
            
        ?>
        
        
        
        <input id="initvideoid" type="hidden" value="<?php print $ytid; ?>" />

        <script>
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
   
                var vidid = document.getElementById("initvideoid").value;

                player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: vidid,
                    events: {
                      'onReady': onPlayerReady,
                      'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
              event.target.playVideo();
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            var done = false;
            function onPlayerStateChange(event) {
              if (event.data == YT.PlayerState.PLAYING && !done) {
                  //play video until timeout
                setTimeout(stopVideo, 6000000);
                done = true;
              }
            }
            function stopVideo() {
              player.stopVideo();
            }
       </script>

    </body>
</html>
<?php
mysqli_close($conn);
?>