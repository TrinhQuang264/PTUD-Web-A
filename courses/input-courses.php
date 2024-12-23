<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khóa Học</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>

    <header class="header">
        <!-- Logo -->
        <div class="logo">
            <a href="../index.php">COURSE</a>
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
                            <li><a href="input-courses.php">Tạo Khóa Học</a></li>
                            <li><a href="table-courses.php">Danh Sách</a></li>
                            <li><a href="find-courses.php">Tìm Kiếm</a></li>
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
    <form action="">
        <p>Mã Khóa Học:</p>
        <input type="text" name="course_id" required>
        <p>Tên Khóa Học:</p>
        <input type="text" name="course_name" required>
        <p>Phân Loại:</p>
        <select name="difficulty_id">
            <?php
            require '../connect.php';
            $sql = "SELECT * FROM difficult";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $difficulty_id = $row["difficulty_id"];
                    $difficulty_name = $row["difficulty_name"];
                    echo "<option value='$difficulty_id'>" . $row["difficulty_name"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <p>Số Bài Học:</p>
        <input type="number" name="lesson_count" required>
        <p>Thời Gian Học:</p>
        <input type="text" name="duration" id="" required>
        <p>Học Phí:</p>
        <input type="text" name="fee" required>
        <p>Ngày Bắt Đầu:</p>
        <input type="text" name="start_date" required>
        <input type="submit" value="Gửi">
        </select>
    </form>
    <?php

    ?>
</body>

</html>
<?php
if (isset($_GET["course_id"]) && isset($_GET["course_name"]) && isset($_GET["difficulty_id"]) && isset($_GET["lesson_count"])  && isset($_GET["duration"])  && isset($_GET["fee"])  && isset($_GET["start_date"])) {
    require '../connect.php';
    $course_id = $_GET["course_id"];
    $course_name = $_GET["course_name"];
    $difficulty_id = $_GET["difficulty_id"];
    $lesson_count = $_GET["lesson_count"];
    $duration = $_GET["duration"];
    $fee = $_GET["fee"];
    $start_date = $_GET["start_date"];

    $check_sql = "SELECT * FROM courses WHERE course_id = '$course_id' AND course_name = '$course_name'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        // Nếu đã tồn tại
        echo "<script>alert('Bạn đã tạo khóa học này rồi!');</script>";
    } else {
        $sql = "INSERT INTO courses(course_id,course_name,difficulty_id,lesson_count,duration,fee,start_date)
            VALUE ('$course_id','$course_name','$difficulty_id','$lesson_count','$duration','$fee','$start_date')";

        //check xem đã nhập thông tin và ok hay chưa
        if ($conn->query($sql) === True) {
            echo "<script>alert('Tạo khóa học thành công!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>