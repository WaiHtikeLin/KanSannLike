<?php
session_start();

$number=$_SESSION['num'];

include("admin/confs/config.php");

$name=mysqli_real_escape_string($conn,$_POST['name']);
mysqli_query($conn,"update users set name='$name',modified_date=now() where number='$number';");
?>