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
      <span id='top'></span>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Đăng Kí Khóa Học <?php echo $row['course_name'] ?></title>
      <link rel="stylesheet" href="./css/header.css" />
      <link rel="stylesheet" href="./css/detail_courses.css" />
    </head>

    <body>
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

      <main id="container">
        <!-- Phần tiêu đề của body  -->
        <div class="title__section">
          <div class="title__box">
            <div class="title__content">
              <div class="breadcrumd"></div>
              <div class="main__title">
                <h1><?php echo $row['course_name'] ?></h1>
              </div>
              <div class="sub__title">
                <span><?php echo $row['sub_title'] ?></span>
              </div>
              <div class="student">
                <span></span>
              </div>
            </div>
            <div class="courses_img">
              <img src="<?php echo $row['course_img'] ?>" alt="Ảnh logo">
            </div>
          </div>
        </div>
        <!-- Phần nội dung của body  -->
        <div class="main__container">
          <div class="main__box">
            <div class="main__content">
              <div class="target_learn__box">
                <!-- ================ Đối tượng học ====================== -->
                <div class="target_learn__box--title">
                  <h2>Đối Tượng học:</h2>
                </div>
                <div class="target_learn__box--content">
                  <?php
                  // xử lý chuỗi lấy từ database ra để xử lý
                  $array_data_raw = explode("\n", $row['target_learn']);
                  $array_data_completed = [];
                  foreach ($array_data_raw as $item) {
                    $item = ltrim($item, "- ");
                    $item = trim($item);
                    $array_data_completed[] = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-dot' viewBox='0 0 16 16'>
                                                <path d='M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3'/>
                                              </svg> " . $item;
                  }
                  echo "<ul class='grid'>";
                  foreach ($array_data_completed as $item) {
                    echo "<li> " . $item . "</li>";
                  }
                  echo "</ul>";

                  ?>
                </div>
              </div>
              <hr>
              <!-- ================ Những gì bạn sẽ học được ====================== -->
              <div class="benefit__box">
                <div class="benefit__box--title">
                  <h2>Những gì bạn sẽ học được:</h2>
                </div>
                <div class="benefit__box--content">
                  <?php
                  // xử lý chuỗi lấy từ database ra để xử lý
                  $array_data_raw = explode("\n", $row['benefit']);
                  $array_data_completed = [];
                  foreach ($array_data_raw as $item) {
                    $item = ltrim($item, "- ");
                    $item = trim($item);
                    $array_data_completed[] = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-lg' viewBox='0 0 16 16'>
                                              <path d='M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z'/>
                                            </svg> " . $item;
                  }
                  echo "<ul class='grid'>";
                  foreach ($array_data_completed as $item) {
                    echo "<li> " . $item . "</li>";
                  }
                  echo "</ul>";

                  ?>
                </div>
              </div>
              <hr>
              <!-- ================ Mô tả khóa học ====================== -->
              <div class="description__box">
                <div class="description__box--title">
                  <h2>Mô tả khóa học:</h2>
                </div>
                <div class="description__box--content">
                  <?php
                  $array_data_raw = explode("\n", $row['description']);
                  $array_data_completed = [];
                  foreach ($array_data_raw as $item) {
                    $item = ltrim($item, "- ");
                    $item = trim($item);
                    $array_data_completed[] = " <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-dash' viewBox='0 0 16 16'>
                                                  <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8'/>
                                                </svg> " . $item;
                  }
                  echo "<ul>";
                  foreach ($array_data_completed as $item) {
                    echo "<li> " . $item . "</li>";
                  }
                  echo "</ul>";

                  ?>
                </div>
              </div>
            </div>
            <div class="course_resgister__box ">

              <div class="course_resgister__content">
                <div class="price">
                  <?php
                  echo $row['fee'] . " đ";
                  ?>
                </div>
                <div class="course__resgister--button">
                  <form action="" method="get">
                    <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                    <input type="submit" name='submit' value="Đăng Ký Ngay">
                  </form>
                </div>
                <?php
                if (isset($_GET['submit'])) {
                  require 'connect.php';
                  if (isset($_SESSION['email']) && isset($_SESSION['fullname']) && isset($_SESSION['phone'])) {
                    $enroll_name = $_SESSION['fullname'];
                    $enroll_email = $_SESSION['email'];
                    $enroll_phone = $_SESSION['phone'];
                    $course_id = $_GET['course_id'];

                    $check_sql = "SELECT * FROM enrolls WHERE enroll_email = '$enroll_email' AND course_id = '$course_id'";
                    $check_result = $conn->query($check_sql);

                    if ($check_result->num_rows > 0) {
                      echo "<script>alert('Bạn đã đăng ký khóa học này rồi!');</script>";
                    } else {
                      $sql = "INSERT INTO enrolls(enroll_name, enroll_email, enroll_phone, course_id)
                              VALUES ('$enroll_name', '$enroll_email', '$enroll_phone', '$course_id')";

                      if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Đăng ký khóa học thành công!');</script>";
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                    }
                    $conn->close();
                  } else {
                    echo "<script>
                            alert('Vui lòng đăng nhập hoặc đăng ký.');
                            window.location.href = 'login.php';
                          </script>";
                  }
                }
                ?>
                <div class="course__resgister--question">
                  <button>Tư Vấn</button>
                </div>
                <hr>
                <div class="course__resgister--detail">
                  <p><strong>Khóa học này bao gồm:</strong></p>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16">
                      <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <span><?php echo $row['lesson_count'] ?> bài học lý và thực hành</span>
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                      <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    <span>Thời lượng khoảng <?php echo $row['duration'] ?> tháng </span>
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-infinity" viewBox="0 0 16 16">
                      <path d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                    </svg>
                    <span>Truy cập suốt đời và kiến thức mới nhất </span>
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                      <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                    </svg>
                    <span>Hỗ Trợ 1 - 1 giảng dạy </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
      </main>
      <div class="button__backtomenu">
        <a href="#top">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
          </svg>
        </a>

      </div>

    </body>

</html>
<?php
  }
}
?>