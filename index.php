<?php
session_start();

if(!isset($_SESSION['num']))
header("location:login.php");



include("admin/confs/config.php");

$number=$_SESSION['num'];

$user=mysqli_query($conn,"select * from users where number='$number';");
$row=mysqli_fetch_assoc($user);
$userid=$row['id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>KanSannLike</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/app.css" />
		<!--
               <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9400126028832869",
    enable_page_level_ads: true
  });
              </script>
<script data-cfasync="false" type="text/javascript" src="https://www.predictivdisplay.com/a/display.php?r=2418211"></script>
<script data-cfasync="false" type="text/javascript" src="https://www.predictivdisplay.com/a/display.php?r=2418219"></script>
		 -->

		 <script src="js/app.js"></script>
	</head>
	<body>
		<header><h1><em>KanSannLike</em></h1>
		<p>Test your luck...<br />Raise your mobile bills...<br />Save your finances...</p>
		</header>

		<nav>
			<ul>
			<li><a id="active">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="profile.php">Profile</a></li>
			</ul>
		</nav>

		<!-- <div id="SC_TBlock_654414" class="SC_TBlock">loading...</div> -->
		<div align="center">
			<p><?= $row['name']." (".$row['number'].") " ?><span id="time">Chances</span><span id="tries"><?= " : ".$row['tries'] ?></span></p>

			<p><a href="logout.php" id="logout">Exit</a></p>
			<p id="choose">Choose operator</p>


			<form action="index.php" method="post" onsubmit="return check()">
				<input type="radio" name="operator" value="mpt"/>
				<img src="image/mpt-logo.png" height="30px" width="100px"/>
				<br />
				<input type="radio" value="mytel" name="operator" />
				<img src="image/mytel.png" height="30px" width="100px" />
				<br />
				<input type="radio" value="ooredoo" name="operator" />
				<img src="image/Ooredoo-logo.png" height="30px" width="100px"/>
				<br />
				<input type="radio" value="telenor" name="operator" />
				<img src="image/Telenor_logo.png" height="30px" width="100px"/>
				<br />
				<input class="btn" type="submit" value="Draw" id="draw" />
			</form>
			</div>

			<div id="overlay"></div>
			<div id="dialog">
				<h2><em>KanSannLike</em></h2>
				<div align="center">
					<div id="content">
					</div>
					<button class="btn" id="hide" onclick="hideDialog()">OK</button>
				</div>
			</div>

			<script>


				// if(isUnicode())
				// {
				// 	document.getElementById("logout").innerHTML="ဖုန်းနံပါတ်မမှန်လျှင်ဒီကိုနှိပ်ပါ";
				// 	document.getElementById("time").innerHTML="ကြိမ်ရေ";
				// 	document.getElementById("choose").innerHTML="ဖုန်းလိုင်းရွေးချယ်ပါ";
				// 	document.getElementById("draw").innerHTML="ကံစမ်းမည်";
				// }

                function showDialog(text){
	 				document.getElementById("content").innerHTML=text;
					document.getElementById("overlay").style.display="block";
					document.getElementById("dialog").style.display="block";
				}

				function hideDialog(){
					document.getElementById("overlay").style.display="none";
					document.getElementById("dialog").style.display="none";
				}

			</script>

<?php
$now=time();
$rewardTime=strtotime($row['reward_time']);
$str="index.php";
	if($now>=$rewardTime)
	{
		$row['tries']+=5;
		$rewardTime=strtotime("tomorrow")+37800;
		mysqli_query($conn,"update users set tries=tries+5,reward_time=from_unixtime($rewardTime) where number='$number';");

?>
<script>
	// if(isUnicode())
	// showDialog("<p>ယနေ့အတွက်ကံစမ်းခွင့်<br/>ကြိမ်ရေ(5)ကြိမ်ရရှိပါသည်</p>");
	// else
	// showDialog("<p>ေယန႔အတြက္ကံစမ္းခြင့္<br/>ႀကိမ္ေရ(5)ႀကိမ္ရရွိပါသည္</p>");
	showDialog("<p>You have 5 chances to try today. Good Luck!");
	document.getElementById("hide").onclick=function ()
{
	hideDialog();
	setTimeout(function(){
	document.getElementById("tries").innerHTML='<?= " : ".$row['tries'] ?>';
	},500);
};

</script>

<?php
}
?>

 <script>
        function check()
				{	var input=document.getElementsByTagName("input");
					var tries=<?= $row['tries'] ?>;
					if(!(input[0].checked || input[1].checked || input[2].checked || input[3].checked))
					{
					// {	if(isUnicode())
					// 		showDialog("<p>ဖုန်းလိုင်းတစ်ခုရွေးပါ</p>");
					// 	else
					// 	showDialog("<p>ဖုန္းလိုင္းတစ္ခုေ႐ြးပါ</p>");

					showDialog('<p>You must choose an operator!</p>');
						return false;
					}
					else{
					if(tries<1)
					{	//if(isUnicode())
						// 	showDialog("<p>ကံစမ်းခွင့်ကြိမ်ရေမရှိတော့ပါ<br/>မနက်ဖြန်ပြန်လာခဲ့ပါ<br/>ကျေးဇူးတင်ပါသည်</p>");
						// else
						// showDialog("<p>ကံစမ္းခြင့္ႀကိမ္ေရမရွိေတာ့ပါ<br/>မနက္ျဖန္ျပန္လာခဲ့ပါ<br/>ေက်းဇူးတင္ပါသည္</p>");
						showDialog("<p>You have no chance left.<br/>Come back tomorrow! See you!</p>");
						return false;
					}
					}
					return true;
				}
    </script>

<?php

if(isset($_POST['operator']))
{
$operator=$_POST['operator'];

$n=mysqli_query($conn,"select count(*) from prizes where name='$operator' and won=0;");
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

$draw=mt_rand(0, $count-1);
//$draw=$choices[0];

mysqli_query($conn,"update users set tries=tries-1,tried=tried+1 where number='$number';");

if(!in_array($draw, $choices)){
?>

<script>

// if(isUnicode())
// 	showDialog("<p>ဝမ်းနည်းပါတယ်<br/>နောက်တစ်ကြိမ်ကံစမ်းပါ</p>");
// else
// showDialog("<p>ဝမ္းနည္းပါတယ္<br/>ေနာက္တစ္ႀကိမ္ကံစမ္းပါ</p>");

showDialog("<p>Sorry.<br/>Try again.</p>");
document.getElementById("hide").onclick=function ()
{
document.location.replace("<?= $str ?>");
};

</script>
<?php
}
else {
    $prize=mysqli_query($conn,"select * from prizes where name='$operator' and won=0 limit 1;");
$row=mysqli_fetch_assoc($prize);
$id=$row['id'];
$code=$row['code'];

mysqli_query($conn,"update prizes set won=1 where id=$id;");
mysqli_query($conn,"insert into winners values ($userid,$id,now());");
?>
<script>

// if(isUnicode())
// 	showDialog("<p>ဂုဏ်ယူပါတယ်<br/>သင်ကံထူးပါသည်<br/><?= $number ?>&nbsp;ကို<br/>message&nbsp;ပို့လိုက်ပါပြီ<</p>");
// else
// showDialog("<p>ဂုဏ္ယူပါတယ္<br/>သင္ကံထူးပါသည္<br/><?= $number ?>&nbsp;ကို<br/>message&nbsp;ပို႔လိုက္ပါၿပီ</p>");
showDialog("<p>Congratulations!<br/>You won!
<br/>Price will be sent. Thank you.</p>");

document.getElementById("hide").onclick=function ()
{
document.location.replace("<?= $str ?>");
};
</script>

<?php
}
}
?>
    <!-- <script type="text/javascript">
  (sc_adv_out = window.sc_adv_out || []).push({
    id : "654414",
    domain : "n.ads3-adnow.com"
  });
</script>
<script type="text/javascript" src="//st-n.ads3-adnow.com/js/a.js"></script> -->
    </body>
</html>
