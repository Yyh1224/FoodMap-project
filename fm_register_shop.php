<?php
       $username = $_POST["Username"];
       $password = $_POST["Password"];
       $name = $_POST["name"];
       $email = $_POST["email"];
       $telephone= $_POST["telephone"];
       $county = $_POST["county"];
       $address = $_POST["address"];
       $category = $_POST["category"];
       $photo = $_POST["photo"];
       $menu = $_POST["menu"];

	session_start();  // 啟用交談期
    $link = mysqli_connect("localhost","root","","foodmap")
            or die("無法開啟MySQL資料庫連接!<br/>");

   	//送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8'); 

	$sql = "INSERT INTO register (RID,PW) VALUES ('$username', '$password')";
  $sql2 = "INSERT INTO shop (SID,name,email,tel,coID,address,caID) VALUES ('$username','$name','$email','$telephone','$county','$address','$category')";
  $sql3 = "INSERT INTO photo (PID,photo) VALUES ('$username','$photo')";
  $sql4 = "INSERT INTO menu (MEID,menu) VALUES ('$username','$menu')";
  
	if ($link->query($sql) && $link->query($sql2) && $link->query($sql3) && $link->query($sql4) === TRUE) {
	 ?>
    <script>
      alert("註冊成功！");
      window.location.assign("fm_visitor.php");
    </script>
  <?php
	} else {
	  echo "Error: " . $sql . "<br>" . $link->error;
	}

  $link->close();
?>