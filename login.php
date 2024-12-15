<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng Nhập</title>
  <link rel="stylesheet" href="login.css" />
  <!-- Link font style-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
</head>
<style>
  .header {
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    background-color: antiquewhite;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .header .logo {
    margin-left: 20px;
    font-size: 30px;
    font-weight: 900;
    letter-spacing: 1px;
  }

  .container {
    min-height: 70vh;
  }

  .nou {
    position: absolute;
    top: 425px;
    font-size: 10px;
    left: 620px;
    color: red;
  }
</style>

<body>
  <!-- Phần header -->
  <header class="header">
    <div class="logo"><a href="index.php">COURSE</a></div>
  </header>
  <!-- Phần Form -->
  <div class="container">
    <form action="" method="post" class="login-box">
      <h2>Đăng Nhập</h2>
      <p>Email:</p>
      <input type="email" name="email" placeholder="Nhập Email" required />
      <p>Mật Khẩu:</p>
      <input
        type="password"
        name="password"
        placeholder="Nhập Mật Khẩu" required /><br />
      <input type="submit" value="Đăng Nhập" class="submit-button" />

      <p class="question-register">
        Bạn chưa có tài khoản? <a href="resgister.php">Đăng Ký</a>
      </p>
    </form>
  </div>
</body>
<?php
if (isset($_POST["email"]) && isset($_POST["password"])) {
  require 'connect.php';
  session_start();

  $email = $_POST["email"];
  $password =  $_POST["password"];

  $sql = "SELECT email, password, last_name, first_name,role_id FROM account Where email = '$email' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  //check xem nhập hay chưa hay bỏ trống hoặc nhập sai
  if ($result->num_rows == 0) {
    echo "<p class='nou'>Vui Lòng Nhập Đầy Đủ Thông Tin!</p>";
    exit;
  } else if ($email != $row["email"] || $password != $row["password"]) {
    echo "<p class='nou'>Tài Khoản hoặc Mật Khẩu bị sai!</p>";
    exit;
  } else {
    // lưu thông tin khi check email và mk đúng
    $_SESSION['email'] = $row['email'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['role_id'] = $row['role_id'];
    header("location: index.php");
  }
} ?>

</html>