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

    if($name!=$name_new or $email!=$email_new or $tel!=$tel_new or $address!=$add_new){
	$sql = "UPDATE shop SET name='$name_new', email='$email_new', tel='$tel_new', address='$add_new' WHERE SID='$account'";

		if ($link->query($sql) === TRUE) {
		?>
		<script>
			alert("修改成功! 請重新登入");
			window.location.assign("fm_login.html");
		</script>
		<?php
		} 
		else {
		  echo "Error: " . $sql . "<br>" . $link->error;
		}
	//$link->close();
	}	
?>
