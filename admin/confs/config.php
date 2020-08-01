<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "kansannlike";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($conn, $dbname);
?>
