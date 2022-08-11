<?php 
	session_start();  // 啟用交談期
	$account = $_POST["username"];
	
	include "connMySQL.php";

	$sql = "SELECT s.name, s.tel, s.address, s.caID, s.coID FROM shop s WHERE s.sid='$account'";

	$result = mysqli_query($link, $sql);
	$total_records = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    $show_ca="SELECT name from category where caID='$row[3]'";
	$show_co="SELECT name from county where coID='$row[4]'";
	$ca=mysqli_query($link,$show_ca);
	$co=mysqli_query($link,$show_co);
	$ca_result=mysqli_fetch_assoc($ca);
	$co_result=mysqli_fetch_assoc($co);

	$menu="SELECT menu FROM `menu` WHERE MEID='$account'";
	$result_m=mysqli_query($link,$menu);

	$photo="SELECT photo FROM `photo` WHERE PID='$account'";
	$result_p=mysqli_query($link,$photo);
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
<h2>店家資訊</h2>
	<table cellspacing="1" cellpadding="5">
	    <tr>
	        <td>店家名稱:</td>
	        <td><input type="text" name="username" value = "<?php echo $row[0] ?>" size="20" maxlength="10" readonly="readonly"></td>
	    </tr>
	    <tr>
	        <td>店家電話:</td>
	        <td><input type="text" name="password" value = "<?php echo $row[1] ?>" size="20" maxlength="10" readonly="readonly"></td>
	    </tr>
	    <tr>
	        <td>地址:</td>
	        <td><input type="text" name="name" size="20" value = "<?php echo $co_result["name"],$row[2]?>"  maxlength="10"readonly="readonly"></td>
	    </tr>
	    <tr>
	        <td>種類:</td>
	        <td><input type="text" name="ca" size="20" value = "<?php echo $ca_result["name"] ?>"  maxlength="10"readonly="readonly"></td>
	    </tr>
	</table>

	<table>
		<h2>會員留言</h2>
		<?php
			$com="SELECT mcomment.*, member.name FROM `MComment`, member WHERE mcomment.member = member.MID AND mcomment.Shop = '$account' ORDER BY mcomment.commentID";
			$result_com=mysqli_query($link,$com);
			if( $row_com = mysqli_fetch_array($result_com) == ''){
		    	echo "<td>尚無資料</td>";
		    }
			while($row_com = mysqli_fetch_array($result_com)){
		?>
		<tr>
			<td style="width: 40px;" align="center">
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

	<table>
	    <tr>
	    	<th colspan="2"><h2>店家菜單</h2></th>
	    <?php
	    	$a=1;
	    	
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
		</tr>
	</table>

	<table>
		<tr>
	    	<th colspan="2"><h2>店家圖片</h2></th>
	    <?php
	    	$a=1;
	    	
			while($row_result_p=mysqli_fetch_assoc($result_p)){
				if($a%2!=0){
					echo "<tr>";	
					echo "<td>";
				}	
				else{
					echo "<td>";
				}
				echo"<img src=".$row_result_p["photo"]." height='200'>";
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
		</tr>
	</table>

	<table cellspacing="1" cellpadding="5">
		<h2>相關文章</h2>
		<?php
		    $post="SELECT shop.SID, shop.name, photo.photo, post.* from post, shop, photo where post.Shop = shop.SID AND shop.SID = photo.PID AND shop.SID = '$account'";
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
	<?php 
		}
		echo"<td style=' border-bottom: 1px solid #dedede'></td>";
		$link->close();
	?>
	</table>

</div>
</body>
</html>
