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

include_once("../dao/CHmessageDao.class.php");
$chmsgdao = new CHmessageDao();

include_once("../dao/CHmsg_countDao.class.php");
$chmsgcntdao = new CHmsg_countDao();

if ($myusn > 0) {
    
    //get count of all the messages sent ever, at the time when the user last logged into chat.
    $mymsgcnt = $chmsgcntdao->getMsgCountByUser($conn, $myusn);
    
    //this gets the count of all messages sent ever
    $totalmsgcnt = $chmsgdao->countAllMessages($conn);
    
    //if there have been new messages
    if ($totalmsgcnt > $mymsgcnt) {
        
        //gets the max number of messages. The id of the last message
        $mxmsgid = $chmsgdao->getMaxId($conn);
        
        //gets the content of the last message
        $newmsg = $chmsgdao->getMessageById($conn, $mxmsgid);
        
        //get user id number by message id
        $owner = $chmsgdao->getUserNumById($conn, $mxmsgid);
        
        //create output as user <owner id number> : The new message
        $out = "<b>User " . $owner . ":</b> " . $newmsg;
        
        //set the users message count to new message count
        $chmsgcntdao->setMsgCountByUser($conn, $myusn, $totalmsgcnt);
    }
}

mysqli_close($conn);

print $out;
?>