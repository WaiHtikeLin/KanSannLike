<?php

session_start();

if(!isset($_SESSION['num']))
header("location:login.php");

$number=$_SESSION['num'];

include("admin/confs/config.php");

$row=mysqli_query($conn,"select * from users where number='$number';");
$row=mysqli_fetch_assoc($row);
$id=$row['id'];
$winTime=mysqli_query($conn,"select count(*) from winners where user_id=$id;");
$winTime=mysqli_fetch_assoc($winTime);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>KanSannLike</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/app.css" />
         <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9400126028832869",
    enable_page_level_ads: true
  });
              </script>
              <script data-cfasync="false" type="text/javascript" src="https://www.predictivdisplay.com/a/display.php?r=2418211"></script>
<script data-cfasync="false" type="text/javascript" src="https://www.predictivdisplay.com/a/display.php?r=2418219"></script> -->

		<script src="js/app.js"></script>

	</head>
	<body>
		<header><h1><em>KanSannLike</em></h1>
		<p>Test your luck...<br />Raise your mobile bills...<br />Save your finances...</p>
		</header>

		<nav>
			<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li><a id="active">Profile</a></li>
			</ul>
		</nav>

<!-- <div id="SC_TBlock_654414" class="SC_TBlock">loading...</div> -->
		<div align="center" id="profile">
			<p><span id="name">Name</span>&nbsp;:&nbsp;<input type="text" value="<?= $row['name'] ?>" disabled/>
				<button class="btn" onclick="change()">Change</button>
				<button class="btn" onclick="edit()" style="display: none">OK</button>
			</p>
			<p><span id="number">Phone Number</span>&nbsp;:&nbsp;<?= $row['number'] ?></p>
			<p><span id="tries">Chances left</span>&nbsp;:&nbsp;<?= $row['tries'] ?></p>
			<p><span id="tried">Tried chances</span>&nbsp;:&nbsp;<?= $row['tried'] ?></p>
<?php
if($winTime['count(*)']==0){
?>
			<p><span id="winTime">Won</span>&nbsp;:&nbsp;<?= $winTime['count(*)'] ?></p>

<?php
}
else {
?>
<p style="display: inline"><span id="winTime">Won</span>&nbsp;:&nbsp;</p>
<select>
<option selected disabled id="byname">
<?= $winTime['count(*)'] ?></option>

	<?php
		$sql="select name,count(*) from (select prizes.name from users,winners,prizes where user_id=users.id and prize_id=prizes.id and number='$number') as byname group by (name);";
		$run=mysqli_query($conn,$sql);

		while($r=mysqli_fetch_assoc($run))
		{
	?>
<option disabled><?= $r['name']." (".$r['count(*)'].")" ?></option>
<?php
		}
		}
?>
</select>
<br />
<br />

			<a href="index.php"><button class="btn">Draw Now</button></a>
			<a href="logout.php"><button class="btn">Exit</button></a>
		</div>
		<script src="js/jquery-3.3.1.js"></script>
		<script>
			// if(isUnicode())
			// {
			// 	document.getElementById("name").innerHTML="နာမည်";
			// 	document.getElementById("number").innerHTML="ဖုန်းနံပါတ်";
			// 	document.getElementById("tries").innerHTML="ကံစမ်းခွင့်ကြိမ်ရေ";
			// 	document.getElementById("tried").innerHTML="ကံစမ်းပြီးကြိမ်ရေ";
			// 	document.getElementById("winTime").innerHTML="မဲပေါက်သည့်ကြိမ်ရေ";
			// }

			function change(){
				document.getElementsByTagName('input')[0].removeAttribute("disabled");
				document.getElementsByTagName('input')[0].focus();
				document.getElementsByTagName('button')[0].style.display="none";
				document.getElementsByTagName('button')[1].style.display="inline";
			}

			function edit()
			{
				var name=document.getElementsByTagName('input')[0].value;
				$.post("updateuser.php",{name:name});
				document.getElementsByTagName('input')[0].disabled="disabled";
				document.getElementsByTagName('button')[1].style.display="none";
				document.getElementsByTagName('button')[0].style.display="inline";
			}

				document.getElementById('byname').style.display="none";

		</script>
<!-- <script type="text/javascript">
  (sc_adv_out = window.sc_adv_out || []).push({
    id : "654414",
    domain : "n.ads3-adnow.com"
  });
</script>
<script type="text/javascript" src="//st-n.ads3-adnow.com/js/a.js"></script> -->
		</body>
</html>
