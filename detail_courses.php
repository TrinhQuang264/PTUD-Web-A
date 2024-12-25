<!DOCTYPE html>
<html lang="en">
<?php
require 'connect.php';
if (isset($_GET['course_id'])) {
  $course_id = $_GET['course_id'];
  $sql = "SELECT c.*, d.* 
        FROM  courses c 
        INNER JOIN  detail_courses d 
        On  c.course_id = d.course_id 
        WHERE c.course_id = '$course_id' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Đăng Kí Khóa Học <?php echo $row['course_name'] ?></title>
      <link rel="stylesheet" href="./css/header.css" />
      <link rel="stylesheet" href="./css/detail_courses.css" />
    </head>

    <body>
      <header class="header">
        <div class="logo">
          <a href="index.php">COURSE</a>
        </div>
        <?php
        session_start();

        if (isset($_SESSION['email'])) { ?>

          <!-- Menu -->
          <ul class="main-menu">
            <li>
              <span>Đăng Ký</span>
              <ul class="submenu">
                <li><a href="./enroll/input-enrolls.php">Đăng Ký</a></li>
                <li><a href="./enroll/table-enrolls.php">Danh Sách</a></li>
                <li><a href="./enroll/find-enroll.php">Tìm Kiếm</a></li>
              </ul>
            </li>
            <?php if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
              <li>
                <span>Khóa học</span>
                <ul class="submenu">
                  <li><a href="./courses/input-courses.php">Tạo Khóa Học</a></li>
                  <li><a href="./courses/table-courses.php">Danh Sách</a></li>
                  <li><a href="./courses/find-courses.php">Tìm Kiếm</a></li>
                </ul>
              </li>
              <li>
                <a href="./account_manage/account_manager.php"><span>Quản Lý Tài Khoản</span></a>
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
                <svg
                  class="dropdown__icon"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-person"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="dropdown__text"><a href="account_info.php">Thông Tin Tài Khoản</a></span>
              </li>
              <li class="dropdown__item">
                <svg
                  class="dropdown__icon"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-box-arrow-right"
                  viewBox="0 0 16 16">
                  <path
                    fill-rule="evenodd"
                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                  <path
                    fill-rule="evenodd"
                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                <span class="dropdown__text"><a href="../logout.php">Đăng Xuất</a></span>
              </li>
            </ul>
          </div>
        <?php
        } else {
          echo "<nav class='navbar'>
                <ul>
                  <li><a href='../login.php'>Đăng Nhập</a></li>
                  <li><a href='../resgister.php'>Đăng Ký</a></li>
                </ul>
              </nav>";
        }
        ?>
      </header>

      <main id="container">
        <!-- Phần tiêu đề của body  -->
        <div class="title__section">
          <div class="title__box">
            <div class="title__content">
              <div class="main__title">
                <span>Khóa Học <?php echo 1; ?></span>
              </div>
              <div class="sub__title">
                <span>Khóa học Frontend dành cho người mới bắt đầu. Hệ thống bài tập
                  khoa học đa dạng từ cơ bản đến nâng cao.</span>
              </div>
              <div class="student">
                <span> Học Viên <br />1000 </span>
              </div>
            </div>
          </div>
        </div>
        <!-- Phần nội dung của body  -->
        <div class="main__container">
          <div class="main__box">
            <div class="main__content"></div>
          </div>
        </div>
      </main>
    </body>

</html>
<?php
  }
}
?>