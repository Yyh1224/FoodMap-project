<?php
    $menu = $_POST["menu"];

	session_start();  // 啟用交談期
	$account = $_SESSION["SID"];
    include "connMySQL.php";

    $add_menu = "INSERT INTO menu (MEID,menu) VALUES ('$account','$menu')";

	if ($link->query($add_menu) === TRUE) {
	  echo "New record created successfully，點擊跳轉回登入頁面";
	  echo '<a href="http://localhost/foodmap/fm_shop_display.php" >店家資訊</a>';
	  //header("Location: login.html");
	} 
	else{
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	//$link->close();

?>
