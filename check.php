<?php
session_start();
include("admin/confs/config.php");
$number=$_POST["phone"];
$_SESSION['num']=$number;
$check=mysqli_query($conn,"select count(*) from users where number='$number';");
$row=mysqli_fetch_assoc($check);


if(!$row['count(*)'])
	header("location: createuser.html");

else
	header("location: index.php");

 
?>