<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thông Tin Tài Khoản</title>
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/account_info.css" />
</head>
<?php
session_start();
?>

<body>
  <?php
  if (!isset($_SESSION['email']) || $_SESSION['role_id'] != 'admin') {
  ?>
    <div class="card--nou">
      <div class="nou-no-admin">
        <h2>Không có quyền truy cập</h2>
        <p style="color:rgb(175, 136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
        <button class="back-to-login-button"><a href="../index.php">Quay lại trang chủ</a></button>
      </div>
    </div>
  <?php
  } ?>
  <!-- Thanh Header và Nav-->
  <header class="header">
    <!-- Logo -->
    <div class="logo">
      <a href="index.php">COURSE</a>
    </div>
    <?php


    if (isset($_SESSION['email'])) { ?>


      <!-- Menu -->
      <ul class="main-menu">
        <li>
          <span>Khóa Học Của Bạn</span>
          <ul class="submenu">
            <li><a href="./enroll/table-enrolls.php">Danh Sách</a></li>
            <li><a href="./enroll/find-enroll.php">Tìm Kiếm</a></li>
          </ul>
        </li>
        <?php if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
          <li>
            <span>Quản Lý Khóa học</span>
            <ul class="submenu">
              <li><a href="./courses/input-courses.php">Tạo Khóa Học</a></li>
              <li><a href="./courses/table-courses.php">Danh Sách</a></li>
              <li><a href="./courses/find-courses.php">Tìm Kiếm</a></li>
            </ul>
          </li>
          <li>
            <span>Quản Lý Tài Khoản</span>
            <ul class="submenu">
              <li><a href="./account_manage/account_manager.php">Danh Sách</a></li>
              <li><a href="./account_manage/find_account.php">Tìm Kiếm</a></li>
            </ul>
          </li>
        <?php
        }
        ?>
      </ul>
      <!-- Bên Phải-->
      <div class="dropdown">
        <div class="dropdown__main">
          <?php
          echo "<span>" . $_SESSION['fullname'] . "</span>";
          ?>
        </div>
        <ul class="dropdown__list">
          <li class="dropdown__item">
            <svg class="dropdown__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
            <span class="dropdown__text"><a href="account_info.php">Thông Tin Tài Khoản</a></span>
          </li>
          <li class="dropdown__item">
            <svg class="dropdown__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
            </svg>
            <span class="dropdown__text"><a href="logout.php">Đăng Xuất</a></span>
          </li>
        </ul>
      </div>

    <?php
    } else {

      echo "<nav class='navbar'>
              <ul>
                <li><a href='login.php'>Đăng Nhập</a></li>
                <li><a href='resgister.php'>Đăng Ký</a></li>
              </ul>
            </nav>";
    }
    ?>
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
      <div class="form-box">
        <form action="" method="post">
          <div class="fullname">
            <label for="fullname">Họ và Tên:</label>
            <input type="text" name="fullname" id="fullname" value="<?php echo $row_info['fullname'] ?>" readonly />
          </div>
          <div class="email">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $row_info['email'] ?>" readonly />
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
                              echo "<span>Quản Trị Viên</span>";
                            } else {
                              echo "<span>Người Dùng</span>";
                            } ?></label>
          </div>
          <div class="create-date">
            <label for="create-date">Ngày Tạo Tài Khoản: <?php echo "<span>" . substr($row_info['register_date'], 0, 10) . "</span>" ?></label>
          </div>
          <div class="footer">
            <div class="change-info">
              <input type="submit" name="change-info-account" value="Chỉnh Sửa" />
            </div>
            <div class="delete-account">
              <input type="submit" name="delete-account" value="Xóa Tài Khoản" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<?php
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['phone'])) {
  require 'connect.php';
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $email_account = $_SESSION['email'];
  mysqli_set_charset($conn, 'UTF8');

  if (strlen($phone) != 10 || substr($phone, 0, 1) != '0') {
    echo "<script> alert('Bạn nhập số điện thoại phải đủ 10 số và phải bắt đầu bằng số 0.');</script>";
    exit();
  }
  $check_phone = "SELECT * FROM account WHERE phone='$phone'";
  $result_check_phone = $conn->query($check_phone);

  if ($result_check_phone->num_rows > 0) {
    echo "<script> alert('Số điện thoại đã tồn tại trong hệ thống. Vui lòng sử dụng số điện thoại khác.');</script>";
    exit();
  }

  if (isset($_POST['change-info-account'])) {
    $sql = "UPDATE account 
          SET fullname = '$fullname', email = '$email', phone = '$phone'
          WHERE email = '$email'";
    if ($conn->query($sql) === True) {
      echo "<script>alert('Bạn đã sửa thành công!');</script>";
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