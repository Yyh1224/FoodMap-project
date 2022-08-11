<?php 
	session_start();  // 啟用交談期
	$account = $_SESSION["SID"];
	$password = $_SESSION["password"];
	$name = $_SESSION["name"];
	$email = $_SESSION["email"];
	$tel = $_SESSION["tel"];
	$category = $_SESSION["caID"];
	$county = $_SESSION["coID"];
	$address = $_SESSION["address"];
	
//pw, account is not changable here
	if(isset($_POST["name"]))
       $name_new = $_POST["name"];
	else $name_new=$name;
    if(isset($_POST["email"]))
       $email_new = $_POST["email"];
	else $email_new=$_SESSION["email"];
	if(isset($_POST["tel"]))
       $tel_new = $_POST["tel"];
	else $tel_new=$_SESSION["tel"];
	if(isset($_POST["caID"]))
       $caID_new = $_POST["caID"];
	else $caID_new=$category;
	if(isset($_POST["coID"]))
       $coID_new = $_POST["coID"];
	else $coID_new=$county;
	if(isset($_POST["address"]))
       $add_new = $_POST["address"];
	else $add_new=$address;
	include "connMySQL.php";
//get category, county name
	$show_ca="Select name from category where caID='$caID_new'";
	$show_co="Select name from county where coID='$coID_new'";
	$ca=mysqli_query($link,$show_ca);
	$co=mysqli_query($link,$show_co);
	$ca_result=mysqli_fetch_assoc($ca);
	$co_result=mysqli_fetch_assoc($co);
	
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>店家資訊</title>
    <link rel=stylesheet type="text/css" href="foodmap.css">
</head>
<body style="background-image: url(design.png);">
<header data-role="header" style="background-color: #feecd4;" >
<a href="http://localhost/foodmap/fm_visitor.php"><img src="foodmap.png" title="美食地圖首頁" style="height: 40px; margin: 15px;"></a>
<div class="box center">
<form action="fm_update_shop.php" method="post">
	<h2>店家資訊</h2>
	<table cellspacing="1" cellpadding="5">
	    <tr>
	        <td>使用者名稱:</td>
	        <td><input type="text" name="username" value = "<?php echo $account ?>" size="20" maxlength="10" readonly="readonly"></td>
	    </tr>
	    <tr>
	        <td>使用者密碼:</td>
	        <td><input type="password" name="password" value = "<?php echo $password ?>" size="20" maxlength="10" readonly="readonly"></td>
	    </tr>
	    <tr>
	        <td>店名:</td>
	        <td><input type="text" name="name" size="20" value = "<?php echo $name_new ?>"  maxlength="10"></td>
	    </tr>
	    <tr>
	        <td>email:</td>
	        <td><input type="text" name="email" size="20" value = "<?php echo $email_new ?>"></td>
	    </tr>
		<tr>
	        <td>telephone:</td>
	        <td><input type="text" name="tel" size="20" value = "<?php echo $tel_new ?>"  maxlength="10"></td>
	    </tr>
		<tr>
	        <td>category:</td>
	        <td><input type="text" name="ca" size="20" value = "<?php echo $ca_result["name"] ?>"  maxlength="10"></td>
	    </tr>
		<tr>
	        <td>county:</td>
	        <td><input type="text" name="co" size="20" value = "<?php echo $co_result["name"] ?>"  maxlength="10"></td>
	    </tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" value="修改"><input type="button" value="登出" onclick="location.href='http://localhost/foodmap/fm_login.html'"></td>
		</tr>
	</table>
</form>
<br><br>
	<table>
		<h2>會員留言</h2>
		<?php
			$com="SELECT mcomment.*, member.name FROM `MComment`, member WHERE mcomment.member = member.MID AND mcomment.Shop = '$account' ORDER BY mcomment.commentID";
			$result_com=mysqli_query($link,$com);
			while($row_com = mysqli_fetch_array($result_com)){
		?>
		<tr>
			<td  align="center">
			<div class="headphoto">?</div>
			<br><span style="font-size: 10px; left: 50%; color: #696969"> ID:<?php echo $row_com["CommentID"];?></span>
			</td>

			<td align="left">
			<span style="font-size: 16px; font-weight: bold;"><?php echo $row_com["name"];?></span><br>
			<div style="font-size: 14px; color: #FFD700;" >
			<?php 
			$rate=$row_com["rate"];
			$star=5-$rate;
			while($rate>0) {echo "★"; $rate--;} 
			echo '<span style="font-size: 14px; color: #bebebe;">';
			while($star>0) {echo "★"; $star--;}?></span></div>
			<?php echo $row_com["content"];?>
		<?php
			}
		?>
			</td>
		</tr>
	</table>
	<form action="fm_message_delete.php" method="post">
		<table>
			<tr>
				<td align="center">
					<span style="font-size: 16px; font-weight: bold;">輸入欲刪除ID:<br><input type="text" name="ID" size="30"/>
				</td>
			</tr>
				<td align="center" style="padding: 0px;">
					<input type="submit" value="刪除">
				</td>
			</tr>
		</table>
	</form>
	<?php
		$menu="SELECT menu FROM `menu` WHERE MEID='$account'";
		$result_m=mysqli_query($link,$menu);
		$a = 1;
	?>
	<br><br>
	<h2>店家菜單</h2>
	<table align="center">
	<form action="fm_update_menu.php" method="post">
			<tr>
				<td align="center">
					<span style="font-size: 16px; font-weight: bold;">加入更多菜單:<br><input type="text" name="menu" size="30"/>
				</td>
			</tr>
				<td align="center" style="padding: 0px;">
					<input type="submit" value="新增菜單">
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
	</form>
	<table>
	<?php
	while($row_result_m=mysqli_fetch_assoc($result_m)){
		if($a%2!=0){
			echo "<tr>";	
			echo "<td>";
		}	
		else{
			echo "<td>";
		}
		echo"<img src=".$row_result_m["menu"]." height='200'>";
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

	<?php
		$photo="SELECT photo FROM `photo` WHERE PID='$account'";
		$result_p=mysqli_query($link,$photo);
		$b=1;
	?>
	<br><br>
	<h2>店家圖片</h2>
	<table align="center">
	<form action="fm_update_photo.php" method="post">
			<tr>
				<td align="center">
					<span style="font-size: 16px; font-weight: bold;">加入更多圖片:<br><input type="text" name="photo" size="30"/>
				</td>
			</tr>
				<td align="center" style="padding: 0px;">
					<input type="submit" value="新增照片">
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
	</form>
	<?php
	while($row_result_p=mysqli_fetch_assoc($result_p)){
		if($b%2!=0){
			echo "<tr>";	
			echo "<td>";
		}	
		else{
			echo "<td>";
		}
		echo"<img src=".$row_result_p["photo"]." height='200'>";
		if($b%2!=0){
			echo "</td>";
		}
		else{
			echo "</td>";
			echo "</tr>";
		}
		$b++;
	}
	$link->close();
	?>
</div>
</body>
</html>
