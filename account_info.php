<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thông Tin Tài Khoản</title>
  <link rel="stylesheet" href="./css/account_info.css" />
</head>
<?php
session_start();
?>

<body>
  <header class="header">
    <div class="logo"><a href="index.php">COURSE</a></div>
  </header>
  <div class="container">
    <div class="box-content">
      <div class="title">
        <h2>Thông Tin Tài Khoản</h2>
      </div>
      <?php
      require 'connect.php';
      $email_account = $_SESSION['email'];

      $sql = "SELECT * FROM account WHERE email = '$email_account'";

      $result = $conn->query($sql);
      $row_info = $result->fetch_assoc();
      ?>
      <form action="" method="post">
        <div class="fullname">
          <label for="fullname">Họ và Tên:</label>
          <input type="text" name="fullname" id="fullname" value="<?php echo $row_info['fullname'] ?>" />
        </div>
        <div class="email">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?php echo $row_info['email'] ?>" />
        </div>
        <div class="phone">
          <label for="phone">Số Điện Thoại:</label>
          <input type="text" name="phone" id="phone" value="<?php
                                                            if (isset($row_info['phone'])) {
                                                              echo $row_info['phone'];
                                                            } else {
                                                              echo "";
                                                            }
                                                            ?>" />
        </div>
        <div class="role">
          <label>Vai Trò: <?php if ($_SESSION['role_id'] == "admin") {
                            echo "Quản Trị Viên";
                          } else {
                            echo "Người Dùng";
                          } ?></label>
        </div>
        <div class="create-date">
          <label for="create-date">Ngày Tạo Tài Khoản: <?php echo substr($row_info['register_date'], 0, 10); ?></label>
        </div>
        <div class="footer">
          <div class="change-info">
            <input type="submit" name="change-info-account" value="Chỉnh Sửa" />
          </div>
          <div class="delete-account">
            <input type="submit" name="delete-account" value="Xóa Tài Khoản" />
            <?php

            ?>
          </div>
        </div>
    </div>
    </form>
  </div>
</body>

</html>
<?php
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['phone'])) {
  require 'connect.php';
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  mysqli_set_charset($conn, 'UTF8');

  if (isset($_POST['change-info-account'])) {
    $sql = "UPDATE account 
          SET fullname = '$fullname', email = '$email', phone = '$phone'
          WHERE email = '$email'";
    if ($conn->query($sql) === True) {
      echo "<script>alert('Bạn đã sửa thành công!');</script>";
      header("location: account_info.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }



  if (isset($_POST['delete-account'])) {
    $sql = "DELETE FROM account WHERE email = '$email_account'";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Tài khoản của bạn đã bị xóa thành công!');</script>";
      session_destroy();
      header("location: index.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
}
?>