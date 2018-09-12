<?php

session_start();

if (isset($_SESSION['myusernum'])) {
    $myusn = intval($_SESSION['myusernum']);
} else {
    $myusn = 0;
}

$msg = trim(filter_input(INPUT_GET, "msg"));

// ----------Database Connection ----------
include_once("../dbconn/MySQLconn.php");
// ----------------End---------------------

include_once("../dao/CHmessageDao.class.php");
$chmsgdao = new CHmessageDao();

if ($myusn > 0 && strlen($msg) > 0) {
    $chmsgdao->addMessage($conn, $msg, $myusn);
}

mysqli_close($conn);
?>