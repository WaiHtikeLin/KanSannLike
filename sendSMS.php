<?php 
include("admin/confs/config.php");

$number=$_GET['number'];
$operator=$_GET['operator'];

$prize=mysqli_query($conn,"select * from prizes where name='$operator' limit 1;");
$row=mysqli_fetch_assoc($prize);
$id=$row['id'];
$code=$row['code'];

mysqli_query($conn,"delete from prizes where id=$id;");


$token = "bOeSTIZ465ktaTnvQ3lFKKFap4mp7zHzfGoIiD-GU-hxOvdjoZB4sjLKOpoFX3yO";

// Prepare data for POST request
$data =array(
    "to" =>      "$number",
    "message" =>      "ေငြျဖည့္နံပါတ္>>>$code\nsent from KanSannLike",
    "sender" =>      ""
);


$ch = curl_init("https://smspoh.com/api/v2/send");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ));

curl_exec($ch);
header("location:profile.php?number=$number");
?>