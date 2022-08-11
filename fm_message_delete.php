<?php
    
    $com_ID = $_POST["ID"];
	session_start();  // 啟用交談期
    include "connMySQL.php";
    $delete = "DELETE from MComment where CommentID='$com_ID'";
    if ($link->query($delete) === TRUE) {
    	?>
    	<script type="text/javascript">
    		alert("刪除成功！");
    		window.location.assign('fm_shop_display.php');
    	</script>
    	<?php
	 
	} 
	else{
		echo "Error: " . $delete . "<br>" . $link->error;
	}

	$link->close();
?>


