<?php 
//資料庫主機設定
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name ="foodmap";
//連線伺服器
$link = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die("Could not connect: ".mysql_error());
//設定字元集與連線校對
mysqli_set_charset($link, 'utf8');
?>
