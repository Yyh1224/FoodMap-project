  <?php
    session_start();
    $account=""; 
    $password="";

    if(isset($_POST["username"]))
        $account = $_POST["username"];
    if(isset($_POST["password"]))
        $password = $_POST["password"];
    // 檢查是否輸入使用者名稱和密碼
    if ($account != "" && $password != "") {
      // 建立MySQL的資料庫連接 
        include "connMySQL.php";

        $sql = "SELECT * FROM register WHERE PW='";
        $sql.= $password."' AND RID='".$account."'";

        //SQL query
        $result = mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        // check if exist
        if ( $total_records > 0 ) {
            //if is a member
            
            $member="SELECT * FROM member WHERE MID='$account'";
            $result_m = mysqli_query($link, $member);
            $total_records_m = mysqli_num_rows($result_m);
            $row_m = mysqli_fetch_array($result_m, MYSQLI_NUM);
            $_SESSION["password"]=$row[1];
            print $total_records;
            if($total_records_m>0){
                print $total_records_m;
                // 成功登入, 指定Session變數
                $_SESSION["login_session"] = true;
                $_SESSION["MID"] = $row_m[0];
                $_SESSION["name"] = $row_m[1];
                $_SESSION["email"] = $row_m[2];
                $_SESSION["tel"] = $row_m[3];
                header("Location:fm_member.php");
                exit;
            }
            //if is a shop
            $shop="SELECT * FROM shop WHERE SID='$account'";
            $result_s = mysqli_query($link, $shop);
            $total_records_s = mysqli_num_rows($result_s);
            $row_s= mysqli_fetch_array($result_s, MYSQLI_NUM);
        
            if($total_records_s>0){
                print $total_records;
                $_SESSION["login_session"] = true;
                $_SESSION["SID"] = $row_s[0];
                $_SESSION["name"] = $row_s[1];
                $_SESSION["email"] = $row_s[2];
                $_SESSION["tel"] = $row_s[3];
                $_SESSION["caID"] = $row_s[4];
                $_SESSION["coID"] = $row_s[5];
                $_SESSION["address"] = $row_s[6];
                header("Location:fm_shop_display.php");
                exit;
            }

        }
        
        else {  // 登入失敗
        ?>
        <script>
          alert("使用者名稱或密碼錯誤!");
          window.location.href='fm_login.html';
        </script>
        <?php
            $_SESSION["login_session"] = false;
        }
        mysqli_close($link);
    }  // 關閉資料庫連接 
    if($account == "" or $password == ""){
?>
    <script>
      alert("欄位不得為空");
      window.location.href='fm_login.html';
    </script>
<?php
        $_SESSION["login_session"] = false;
    }
    
?>