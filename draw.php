<?php
include("admin/confs/config.php");

$number=$_POST['number'];
$operator=$_POST['operator'];

$n=mysqli_query($conn,"select count(*) from prizes where name='$operator';");
$num=mysqli_fetch_assoc($n);
$num=$num['count(*)'];
$users=mysqli_query($conn,"select count(*) from users");
$users=mysqli_fetch_assoc($users);
$users=$users['count(*)'];
$count=5*$users;

$choices=array();

if($num!=0)
{
	for($i=0;$i<$num;$i++)
	{
		while(in_array($n=mt_rand(0, $count-1), $choices));
		$choices[]=$n;
	}
}
else {
	$choices[]=$count;
}

//$draw=mt_rand(0, $count-1);
$draw=$choices[0];

mysqli_query($conn,"update users set tries=tries-1 where number='$number';");
$str=null;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>KanSannLike</title>
		<link rel="stylesheet" href="css/index.css" />


		<style>
body{
background: #000;
opacity: 0.8;
}

#dialog
{
	display: block
}

		</style>
		</head>
	<body>

		<div id="dialog">
	<h2><em>KanSannLike</em></h2>
	<div align="center">


<?php
if(!in_array($draw, $choices)){
$str="profile.php?number=$number";
?>
<p>Sorry.</p>
<p>Try again.</p>


<?php

}
else {
$str="sendSMS.php?number=$number&operator=$operator";
	?>
<p>Congratulations!</p>
<p>You won!</p>
<p>Price will be sent. Thank you.</p>

<?php
}
?>

<button class="btn" onclick="hideDialog()">OK</button>
</div>
</div>
<script>
	function hideDialog()
	{
		document.getElementById("dialog").style.display = "none";
		document.location.replace("<?= $str ?>");
	}

</script>

</body>
</html>
