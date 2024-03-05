<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

// Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    include('ketnoi.php');

    // Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);

    // Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Mã hóa password
    $password = md5($password);

    // Kiểm tra tên đăng nhập có tồn tại không
    $query = query("SELECT username, password FROM member WHERE username='$username'");
    if (mysqli_num_rows($query) == 0) {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Lấy mật khẩu trong database ra
    $row = mysqli_fetch_assoc($query);

    // So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='trangchu.php'>Về trang chủ</a>";
    die();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Đăng nhập</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0; 
        padding-top: 100px;
        max-width: 40%;
        padding-left: 30%; 
      }
      h1 {
        text-align: center;
        margin-bottom: 20px; 
        }

      table {
        border-collapse: collapse;
        width: 100%; 
      }

      th, td {
        padding: 10px; 
        border: 1px solid #ddd; 
        text-align: left; 
      }

      th {
        background-color: #f2f2f2; 
      }

      input[type="text"],
      input[type="password"] {
        width: 100%; 
        padding: 5px; 
        border: 1px solid #ccc; 
      }

      input[type="submit"] {
        background-color: #4CAF50; 
        color: white;
        padding: 10px 20px; 
        border: none; 
        border-radius: 4px;
        cursor: pointer; 
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      a {
        color: #000; 
        text-decoration: none; 
      }

      a:hover {
        color: #c0c0c0; 
      }
    </style>
  </head>
  <body>
    <h1>TRANG ĐĂNG NHẬP</h1>
    <form action="dangnhap.php?do=login" method="POST">
      <table>
        <tr>
          <th>Tên đăng nhập:</th>
          <td><input type="text" name="txtUsername" /></td>
        </tr>
        <tr>
          <th>Mật khẩu:</th>
          <td><input type="password" name="txtPassword" /></td>
        </tr>
      </table>
      <input type="submit" name="dangnhap" value="Đăng nhập" />
      <a href="dangky.php" title="Đăng ký">Đăng ký</a>
    </form>
  </body>
</html>
