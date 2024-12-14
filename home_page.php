<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang Chủ</title>
  <link rel="stylesheet" href="home-page.css" />
</head>
<style>
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
</style>

<body>
  <header class="header">
    <div class="logo"><a href="home_page.php">COURSE</a></div>
    <?php
    session_start();
    if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
      echo "<div class='manager'> Vài trò: Quản Trị Viên</div>";
      echo "<nav class='navbar'>
                <ul>
                  <li><a href='logout.php'>Đăng Xuất</a></li>
                </ul>
              </nav>";
    } else if (isset($_SESSION['email'])) {
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
  if (isset($_SESSION['email'])) {
  ?>
    <aside>
      <ul class="main-menu">
        <li>
          Đăng Ký Khóa Học
          <ul class="submenu">
            <li><a href="input-enrolls.php">Đăng Ký </a></li>
            <li><a href="table-enrolls.php">Danh Sách </a></li>
            <!-- <li><a href="find-enroll.php">Tìm Kiếm </a></li> -->
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
            <!-- <li><a href="find-enroll.php">Tìm Kiếm </a></li> -->
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
    <main>

      Đề tài: Quản lý trung tâm đào tạo Lập trình <br />
      Mô tả: Hệ thống quản lý trung tâm đào tạo giúp theo dõi thông tin về khóa
      học, giảng viên và học viên.
    </main>
</body>

</html>