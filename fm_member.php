<?php
	session_start();
	$account = $_SESSION["MID"];
	$name = $_SESSION["name"];
	include "connMySQL.php";

	$string = substr("$name", 0, 1);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>美食地圖</title>
	<link rel=stylesheet type="text/css" href="foodmap.css">
</head>
<body style="background-image: url(food.png);">
	<header data-role="header" style="background-color: #feecd4;" >
	<a href="http://localhost/foodmap/fm_member.php"><img src="foodmap.png" title="美食地圖首頁" style="height: 40px; margin: 15px;"></a>
	<table cellspacing="1" cellpadding="5" style="float: right; margin-top: 5px;">
		<tr>
			<td>
				<form name="display_m" action="fm_member_display.php" method="post">
				<input type="hidden" name="username" value="<?php echo $account ?>">
				<button class="memberphoto" onclick="fm_member_display.php"><?php echo strtoupper("$string") ?></button>
				</form>
			</td>
			<td>
			<input type="button" value="登出" onclick="location.href='http://localhost/foodmap/fm_visitor.php'">
			</td>
		</tr>
	</table>
	</header>

<table>
	<td class="title">想知道更多美食</td>
</table>

<table>
		<form action="fm_search.php" method="post">
		<td align="center">
		<div class="searchbox">
			<input  class="textinput" type="text" name="search" placeholder="店家名稱" /><button class="search"><img style="height: 40px;width: 40px;" src="放大鏡.png"></button>
		</div>
		</td>
		</form>
</table>

<table>
	<tr>
		<td colspan="2"><span style="font-size: 30px; font-weight: bold; color: #ffb366;">熱門餐廳</td>
	</tr>
</table>

<table>
		<?php
			$popular_s = "SELECT register.RID, register.PW, shop.name, round(AVG(mcomment.rate),1), photo.photo FROM `shop`,`MComment`,`photo`, `register` WHERE shop.SID = MComment.Shop and shop.SID = photo.PID and register.RID = shop.SID GROUP by mcomment.Shop HAVING AVG(mcomment.rate) ORDER BY round(AVG(mcomment.rate),1) DESC";
			$result_popu = mysqli_query($link,$popular_s);
			$total_popu=mysqli_num_rows($result_popu);  
			$a=1;
			while($row_result_popu = mysqli_fetch_array($result_popu)){
				if($a%2!=0){
					echo "<tr>";	
					echo "<td>";
				}	
				else{
					echo "<td>";
				}
				?>
				<form name="display" action="fm_mshop_display.php" method="post">
				<button class="shop" onclick="show_shop()" style="background-image: url(<?php echo $row_result_popu["photo"]?>); background-size: auto 210px; background-repeat: no-repeat; background-position: top;" >
				<input type="hidden" value="<?php echo $row_result_popu["RID"] ?>" name="username">
				<span class="text">
				<?php
				echo $row_result_popu["name"],"<br>";
				?>
				<div style="font-size: 14px; color: #FFD700;" >
				<?php 
				$num=$row_result_popu["round(AVG(mcomment.rate),1)"];
				$rate=$row_result_popu["round(AVG(mcomment.rate),1)"];
				$star=5-$rate;
				while($rate>0) {echo "★"; $rate--;} 
				echo '<span style="font-size: 14px; color: #bebebe;">';
				while($star>=1) {echo "★"; $star--;} echo"($num)"?></span></div>
				</span>
				</button>
				</form>
				<?php
				if($a%2!=0){
					echo "</td>";
				}
				else{
					echo "</td>";
					echo "</tr>";
				}
				$a++;
			}
		?>
</table>	

<br><br>

<table>
	<tr>
		<td colspan="2"><span style="font-size: 30px; font-weight: bold; color: #ffb366;">各式餐廳</td>
	</tr>
</table>

<table>
		<?php
			$random_s = "SELECT register.RID, register.PW, shop.name, photo.photo FROM `register`,`shop`,`photo` WHERE shop.SID = photo.PID and register.RID = shop.SID GROUP BY shop.name ORDER BY rand() LIMIT 4";
			$result_random = mysqli_query($link,$random_s);
			$b=1;
			while($row_result_random = mysqli_fetch_array($result_random)){
				if($b%2!=0){
					echo "<tr>";	
					echo "<td>";
				}	
				else{
					echo "<td>";
				}
				?>
				
				<form name="display" action="fm_mshop
				_display.php" method="post">
				<button class="shop" onclick="show_shop()" style="background-image: url(<?php echo $row_result_random["photo"]?>); background-size: auto 210px; background-repeat: no-repeat; background-position: top;" >
				<input type="hidden" value="<?php echo $row_result_random["RID"] ?>" name="username">
				<span class="text">
				<?php
				
				echo $row_result_random["name"],"<br>";
				?>
				</span>
				</button>
				</form>
				<?php
				if($b%2!=0){
					echo "</td>";
				}
				else{
					echo "</td>";
					echo "</tr>";
				}
				$b++;
			}
		?>
</table>	

   <div class="box center">
	<table cellspacing="1" cellpadding="5">
		<h2>美食文章</h2>
		<?php
		    $post="SELECT shop.SID, shop.name, photo.photo, post.* from post, shop, photo where post.Shop = shop.SID AND shop.SID = photo.PID";
		    $result_post=mysqli_query($link,$post);
		    while($row_result_post=mysqli_fetch_array($result_post)){
		?>
		<tr>
			<td style=" border-top: 1px solid #dedede">
				<h1 align='left'><span style="color: #BF3434"><?php echo $row_result_post["Title"];?></span></h1>
				<span style="color: #707070;"><h3>作者：<?php echo $row_result_post["member"]; ?></h3></span>
				<?php echo $row_result_post["content"]; ?>
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<form name="display" action="fm_vshop
				_display.php" method="post">
				<button class="shop2" onclick="show_shop()" style=" background-size: auto 210px;" >
				<input type="hidden" value="<?php echo $row_result_post["SID"] ?>" name="username">
				<span class="text">
				<?php
				echo $row_result_post["name"],"<br>";
				?>
				</span>
				</button>
				</form>
			</td>
		</tr>
	<?php
		}
		echo"<td style=' border-bottom: 1px solid #dedede'></td>";
	?>
	</table>
</div>

   
</body>
</html>

<script type="text/javascript">
	function show_shop(){
		document.display.submit();
	}
	function show_member(){
		document.display_m.submit();
	}
</script>

