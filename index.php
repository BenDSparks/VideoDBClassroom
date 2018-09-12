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


if (isset($_SESSION['myusernum'])) {
    //echo "TEST Session set";
    $myusn = intval($_SESSION['myusernum']);
    //TEST remove unset to check session
    //session_unset();
} else {
    //echo "TEST Session not set";
    $chusrcntdao->addUserCount($conn);
    $myusn = $chusrcntdao->getMaxId($conn);
    
    $_SESSION['myusernum'] = $myusn;
    
    $totalmsgcnt = $chmsgdao->countAllMessages($conn);
    
    $chmsgcntdao->addMsgCount($conn, $myusn, $totalmsgcnt);
}


if(isset($_GET{'buttonChoice'})){
    
    
    
    
    
    
    
    
}



?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php print $myusn; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        

    </head>
    <body>
        <a href="chat.php?buttonChoice=instructor"><button type="button">Instructor</button></a>
        <a href="chat.php?buttonChoice=student"><button type="button">Student</button></a>
    </body>
</html>
<?php
mysqli_close($conn);
?>