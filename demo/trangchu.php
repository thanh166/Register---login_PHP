<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>TRANG CỦA BẠN</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
       <?php 
       if (isset($_SESSION['username']) && $_SESSION['username']){
            $username = (isset($_SESSION['username'])) ? $_SESSION['username'] : '';
            
            echo "Tên đăng nhập: " . $username . "<br/>"; 

            echo "<a href='dangnhap.php'>Đăng xuất</a>";
       }
       else{
           echo 'Bạn chưa đăng nhập';
       }
       ?>
    </body>
</html>