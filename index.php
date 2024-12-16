<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang Chủ</title>
  <link rel="stylesheet" href="home-page.css" />
</head>
<style>
  body {
    background-color: rgb(255, 244, 244);
  }

  .header {
    border-bottom: 2px solid black;
  }

  .header .manager {
    margin-left: 20px;
  }

  aside {
    position: sticky;
    top: 60px;
    left: 0;
    right: 0;
    background-color: aquamarine;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 30px;
  }

  aside ul {
    display: flex;
    padding: 0;
    margin: 0;

  }

  aside ul li {
    list-style: none;
    margin-left: 20px;
  }

  /*menu con */
  .main-menu {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  /* Các mục trong menu chính */
  .main-menu li {
    position: relative;
    margin-bottom: 10px;
  }

  /* Menu con (submenu) mặc định ẩn */
  .submenu {
    display: none;
    position: absolute;
    /* Đặt menu phụ sang bên phải */
    top: 20px;
    background-color: lightblue;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 150px;
  }

  /* Hiển thị submenu khi di chuột vào menu chính */
  .main-menu li:hover .submenu {
    display: block;
  }

  .submenu li {
    margin-bottom: 5px;
  }

  main {
    height: auto;
    margin-left: 20px;
    margin-right: 20px;
  }

  main .title {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 20px;
  }

  .list_courses {
    margin-left: 10px;
    margin-right: 10px;
    height: auto;
  }

  .list_courses .template_course {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    margin-left: 60px;
    row-gap: 40px;
    column-gap: 20px;
  }

  .list_courses .grid_item {
    width: 280px;
    border-radius: 5px;
    padding: 5px;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.4);
    background-color: white;
  }

  .list_courses .grid_item-price {
    color: red;
    font-weight: 500;
  }

  .list_courses p,
  h3 {
    margin-left: 10px;
  }
</style>

<body>
  <!-- Thanh Header và Nav-->
  <header class="header">
    <div class="logo"><a href="index.php">COURSE</a></div>
    <?php
    session_start();
    // Phần Quyền Hiện Thị Phần Header
    if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
      echo "<div class='manager'> Vài trò: Quản Trị Viên</div>";
      echo "<nav class='navbar'>
                <ul>
                  <li><a href='logout.php'>Đăng Xuất</a></li>
                </ul>
              </nav>";
    } else if (isset($_SESSION['email'])) {
      echo "<div class='manager'> Vài trò: Người Dùng</div>";
      echo "<nav class='navbar'>
                <ul>
                  <li><a href='logout.php'>Đăng Xuất</a></li>
                </ul>
              </nav>";
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
  <?php
  // Phần Quyền Hiện Thị Phần Navbar
  if (isset($_SESSION['email'])) {
  ?>
    <aside>
      <ul class="main-menu">
        <li>
          Đăng Ký Khóa Học
          <ul class="submenu">
            <li><a href="input-enrolls.php">Đăng Ký </a></li>
            <li><a href="table-enrolls.php">Danh Sách </a></li>
            <li><a href="find-enroll.php">Tìm Kiếm </a></li>
          </ul>
        </li>
      <?php
    }
      ?>
      <?php
      if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
      ?>
        <li>
          Khóa học
          <ul class="submenu">
            <li><a href="input-courses.php">Tạo Khóa Học</a></li>
            <li><a href="table-courses.php">Danh Sách</a></li>
            <li><a href="find-courses.php">Tìm Kiếm </a></li>
          </ul>
        </li>
        <li>
          <a href="account_manager.php">Quản Lý Tài Khoản</a>
        </li>
      </ul>
    <?php
      }
    ?>
    </aside>
    <!--Phần Body hiện thị tự động khóa học từ csdl courses -->
    <main>
      <div class="title">
        <h2>Các Khóa Học của Chúng Tôi:</h2>
      </div>
      <div class="list_courses">
        <div class="template_course">
          <?php
          require 'connect.php';
          $sql = "SELECT course_id,course_name,d.difficulty_name,lesson_count,duration,fee, start_date         
                        FROM  courses c
                        INNER JOIN  difficult d On  c.difficulty_id = d.difficulty_id;";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
              $row = $result->fetch_assoc();
              echo "<div class='grid_item'>";
              echo "<h3 class='grid_item-name'>" . $row["course_name"] . " - " . $row["difficulty_name"] . "</h3>";
              echo "<p class='grid_item-price'>" . $row["fee"] . "<span> VND</span>" . "</p>";
              echo "<p class='grid_item-amount'> <b>Số Lượng:</b> " . $row["lesson_count"] . " Bài ~ " . trim($row["duration"]) . " Tháng" . "</p>";
              echo "<p class='grid_item-date'><b>Ngày Bắt Đầu Học: </b>" . $row["start_date"] . "</p>";
              echo "</div>";
            }
          }
          ?>
        </div>
      </div>

    </main>
</body>

</html>