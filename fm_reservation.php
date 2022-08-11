<?php
       	$people = $_POST["people"];
       	$date=$_POST["date"];
        $note=$_POST["note"];
		$shop=$_POST["shop"];
	    session_start();

        $member = $_SESSION["MID"];
        include "connMySQL.php";

        $sql_reserve = "INSERT INTO Reservation (Shop,member,time,people,note) VALUES ('$shop','$member','$date','$people','$note')";

	if ($link->query($sql_reserve) === TRUE) {
?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>新增</title>
	  	<link rel=stylesheet type="text/css" href="foodmap.css">
	  </head>
	  <body style="background-image: url(food.png);">
	  	<div class="box center-in-center">
	  		<form name="display" action="fm_mshop_display.php" method="post">
	  			<h2>新增成功！</h2>
	  			<input type="hidden" value="<?php echo $shop ?>" name="username">
	  			<input type="button" onclick="show_shop()" value="確定">
	  		</form>
	  </body>
	  </html>
<?php

	} else {
	  echo "Error: " . $sql_reserve . "<br>" . $link->error;
	}

?>
<script type="text/javascript">
	function show_shop(){
		document.display.submit();
	}
</script>