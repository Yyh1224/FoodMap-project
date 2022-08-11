<?php 
	session_start();  // 啟用交談期
	$account = $_SESSION["MID"];
	$password = $_SESSION["password"];
	$name = $_SESSION["name"];
	$email = $_SESSION["email"];
	$tel = $_SESSION["tel"];
	
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
	include "connMySQL.php";
	
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>會員資訊</title>
    <link rel=stylesheet type="text/css" href="foodmap.css">
</head>
<body style="background-image: url(design.png);">
<header data-role="header" style="background-color: #feecd4;" >
<a href="http://localhost/foodmap/fm_member.php"><img src="foodmap.png" title="美食地圖首頁" style="height: 40px; margin: 15px;"></a>
<div class="box center">
<form action="fm_update_member.php" method="post">
	<h2 style="margin-top: -60px; margin-bottom: 50px;">會員資訊</h2>
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
	        <td>姓名:</td>
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
			<td align="center" colspan="2"><input type="submit" value="修改"><input type="button" value="登出" onclick="location.href='http://localhost/foodmap/fm_login.html'"></td>
		</tr>
	</table>
</form>