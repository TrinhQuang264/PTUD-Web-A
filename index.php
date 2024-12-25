<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang Chủ</title>
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="index.css">
</head>

<body>
  <!-- Thanh Header và Nav-->
  <header class="header">
    <!-- Logo -->
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
  <!-- phần Body hiện thị tự động khóa học từ csdl courses -->
  <main>
    <div class="title">
      <h2>Các Khóa Học của Chúng Tôi:</h2>
    </div>
    <div class="list_courses">
      <div class="template_course">
        <?php
        require 'connect.php';
        $sql = "SELECT course_id,course_name,d.difficulty_name,lesson_count,duration,fee,course_img        
                        FROM  courses c
                        INNER JOIN  difficult d On  c.difficulty_id = d.difficulty_id;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();

            echo "<div class='grid_item'>";
            echo "<a href='detail_courses.php?course_id=" . $row['course_id'] . "'>";
            echo "<img class='grid_item-img' src = '" . $row["course_img"] . "' alt = 'Ảnh Khóa Học " . $row["course_name"] . "' >";
            echo "<h3 class='grid_item-name'>" . $row["course_name"] . " - " . $row["difficulty_name"] . "</h3>";
            echo "<p class='grid_item-price'>" . $row["fee"] . "<span> VND</span>" . "</p>";
            echo "<p class='grid_item-amount'> <b>Số Lượng:</b> " . $row["lesson_count"] . " Bài ~ " . trim($row["duration"]) . " Tháng" . "</p>";
            echo "</a>";
            echo "</div>";
          }
        }
        ?>
      </div>
    </div>

  </main>
</body>

</html>