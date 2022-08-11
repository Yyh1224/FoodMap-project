<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>搜尋結果</title>
    <link rel=stylesheet type="text/css" href="foodmap.css">
</head>
<div class="box center">
<body style="background-image: url(food.png);">
<?php
echo 
    "<table>
        <tr>
            <h2>相關店家</h2>";
            $search = $_POST["search"];
            session_start();  // 啟用交談期
            include "connMySQL.php";
            function print_shop($result){
                while($row=mysqli_fetch_assoc($result)) {
                    include "connMySQL.php";
                    echo"<h4>".$row['name']."</h4>";
                    echo"<p>telephone:".$row['tel']."</p>";
                    echo"<p>Address:".$row['address']."</p>"; 
                    echo"<p>Menu:</p>";
                    $SID=$row['SID'];
                    $sql_menu = "SELECT * FROM menu WHERE menu.MEID ='$SID'";
                    $result_m=mysqli_query($link,$sql_menu);
                    while($row_m=mysqli_fetch_assoc($result_m)) {
                        echo"<img src=".$row_m["menu"]." height='200'>";
                    }
                    echo"<p>Photo:</p>";
                    $sql_photo = "SELECT * FROM photo WHERE photo.PID ='$SID'";
                    $result_p=mysqli_query($link,$sql_photo);
                    while($row_p=mysqli_fetch_assoc($result_p)) {
                        echo"<img src=".$row_p["photo"]." height='200'>";
                    }
                }
            }
            //func search category, county
            function search_C($sql,$no_c) { 
                include "connMySQL.php";
                $search = $_POST["search"];
                $result=mysqli_query($link,$sql);
                $total=mysqli_num_rows($result); 
                if($total!=0){
                    while($row=mysqli_fetch_assoc($result)) {
                        $no=$row[$no_c];
                        $sql2 = "SELECT * FROM shop WHERE shop.$no_c = '$no'";
                        $result2=mysqli_query($link,$sql2);
                        print_shop($result2);
                    }
                }else{
                echo"<p>查無相關店家</p>";
                }
            }
            $sql_search = "SELECT * FROM shop WHERE shop.name LIKE '%$search%'";
            $result_search=mysqli_query($link,$sql_search);
            $total_search=mysqli_num_rows($result_search);
            if($total_search!=0){
                print_shop($result_search);
            }
            else{
                echo"<p>查無相關店家</p>";
            }
        echo"</tr>";
        echo"<h2>相關料理種類店家</h2>";
            $search_ca = "SELECT * FROM category WHERE category.name LIKE '%$search%'";
            search_C($search_ca,"caID");
        echo"<tr>";
        echo"<h2>相關地區店家</h2>";
            $search_co = "SELECT * FROM county WHERE county.name LIKE '%$search%'";
            search_C($search_co,"coID");
           
        echo"</tr>";
    echo"</table>";?>
</body>