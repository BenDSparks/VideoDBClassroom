<?php

session_start();

if (isset($_SESSION['myusernum'])) {
    $myusn = intval($_SESSION['myusernum']);
} else {
    $myusn = 0;
}

$out = "";

// ----------Database Connection ----------
include_once("../dbconn/MySQLconn.php");
// ----------------End---------------------

include_once("../dao/MyVideoDao.class.php");
$myVideoDao = new MyVideoDao();

include_once("../dao/MyDao.class.php");
$myDao = new MyDao();

if ($myusn > 0) {
    
    
   if ($myDao->amITheInstructor($conn, $myusn)){
       //if i am the instructor do nothing
    }
    else{
            //if there is an instructor
            if ($myDao->checkInstructor($conn) == 0) {
                
                //get what video im watching
                $videoImWatching = $myVideoDao->getVideoWatching($conn, $myusn);

                //get what video the instructor is watching
                $videoInstructorIsWatching = $myVideoDao->getInstructorVideo($conn, $myusn);

                //check if they are not the same videos
                if ($videoImWatching != $videoInstructorIsWatching){
                    $out = $videoInstructorIsWatching;
                    
                    //set my video to the one the instructor is watching
                    $myVideoDao->setVideoWatching($conn, $myusn, $videoInstructorIsWatching);
                }
            }
    
    
    }

   
}

mysqli_close($conn);
print $out;
?>