<?php
session_start();
include("admin/confs/config.php");

$name=mysqli_real_escape_string($conn,$_POST['user']);
$number=$_SESSION['num'];

$sql="insert into users (number,name,tries,created_date,modified_date) values ('$number','$name',0,now(),now());";

mysqli_query($conn,$sql);

header("location: index.php");

?>