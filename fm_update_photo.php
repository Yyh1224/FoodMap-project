<?php
    $photo = $_POST["photo"];

	session_start();  // 啟用交談期
	$account = $_SESSION["SID"];
    include "connMySQL.php";

	$add_photo = "INSERT INTO photo (PID,photo) VALUES ('$account', '$photo')";

	if ($link->query($add_photo) === TRUE) {
	  echo "New record created successfully，點擊跳轉回登入頁面";
	  echo '<a href="http://localhost/foodmap/fm_shop_display.php" >店家資訊</a>';
	  //header("Location: login.html");
	} 
	else{
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	//$link->close();

?>
