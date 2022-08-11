<?php
       $username = $_POST["Username"];
       $password = $_POST["Password"];
       $name = $_POST["name"];
       $email = $_POST["email"];
       $telephone= $_POST["telephone"];

	session_start();  // 啟用交談期
    include "connMYSQL.php";

	$sql = "INSERT INTO register (RID,PW) VALUES ( '$username', '$password')";
	$sql2 = "INSERT INTO member (MID, name, email, tel) VALUES ( '$username', '$name', '$email', '$telephone')";

	if ($link->query($sql) && $link->query($sql2)  === TRUE) {
	?>
		<script>
			alert("註冊成功!");
			window.location.assign("fm_visitor.php");
		</script>
	<?php
	} else {
	  echo "Error: " . $sql . "<br>" . $link->error;
	}
?>
			