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

    if($name!=$name_new or $email!=$email_new or $tel!=$tel_new){
	$sql = "UPDATE member SET name='$name_new', email='$email_new', tel='$tel_new' WHERE MID='$account'";

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

<script type="text/javascript">
	function show_m(){
		document.display.submit();
	}
</script>
