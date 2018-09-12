<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "admin";
$dbname = "chatdb";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$conn) {
  die('Could not connect: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8');

?>