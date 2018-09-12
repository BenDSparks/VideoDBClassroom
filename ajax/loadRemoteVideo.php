<?php

// ----------Database Connection ----------
include_once("../dbconn/MySQLconn.php");
// ----------------End---------------------

include_once("../dao/MCvideoDao.class.php");

$mcviddao = new MCvideoDao();

include_once("../dao/MyVideoDao.class.php");

$myvideodao = new MyVideoDao();

//$uri = $_SERVER['REQUEST_URI'];
// $uri; // Outputs: URI

//id is the video 
if (isset($_GET['id'])) {
    $vid = intval($_GET['id']);
} else {
    print "no vid number";
    $vid = -1;
}

if (isset($_GET['myusn'])) {
    $myusn = intval($_GET['myusn']);
} else {
    print "no usn";
    $vid = -1;
}

$ytid = '';

if ($vid > -1) {
    //print "vid number: " . $vid;
    //gets the youTube URLid by id
    $ytid = $mcviddao->getYoutubeIdById($conn, $vid + 1);
    //print "ytid " . $ytid;
    //sets the users video they are watching
    $myvideodao->setVideoWatching($conn, $myusn, $vid);
    
}

mysqli_close($conn);
print $ytid;
?>