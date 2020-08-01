<?php

    session_start();
    unset($_SESSION['num']);
    header("location:login.php");

?>	
