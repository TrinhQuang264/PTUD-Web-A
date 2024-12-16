<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khóa Học</title>
    <link rel="stylesheet" href="home-page.css">
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

    <?php
    session_start();
    if (isset($_SESSION['email']) && $_SESSION['role_id'] != 'admin') {
    ?>
        <div class="card--nou">
            <div class="nou-no-admin">
                <h2>Không có quyền truy cập</h2>
                <p style="color:rgb(175, 136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
                <button class="back-to-login-button"><a href="index.php">Quay lại trang chủ</a></button>
            </div>
        </div>
    <?php
    }

    if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
    ?>
        <header class="header">
            <div class="logo"><a href="index.php">COURSE</a></div>
        <?php
        echo "<div class='manager'> Vài trò: Quản Trị Viên</div>";
        echo "<nav class='navbar'>
                      <ul>
                        <li><a href='logout.php'>Đăng Xuất</a></li>
                      </ul>
                    </nav>";
    }
        ?>
        </header>
        <?php
        if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
        ?><aside>
                <ul class="main-menu">
                    <li>
                        Đăng Ký Khóa Học
                        <ul class="submenu">
                            <li><a href="input-enrolls.php">Đăng Ký </a></li>
                            <li><a href="table-enrolls.php">Danh Sách </a></li>
                            <li><a href="find-enroll.php">Tìm Kiếm </a></li>
                        </ul>
                    </li>

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
            </aside>
            <form action="">
                <p>Mã Khóa Học:</p>
                <input type="text" name="course_id" required>
                <p>Tên Khóa Học:</p>
                <input type="text" name="course_name" required>
                <p>Phân Loại:</p>
                <select name="difficulty_id">
                    <?php
                    require 'connect.php';
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
        }
        ?>
</body>

</html>
<?php
if (isset($_GET["course_id"]) && isset($_GET["course_name"]) && isset($_GET["difficulty_id"]) && isset($_GET["lesson_count"])  && isset($_GET["duration"])  && isset($_GET["fee"])  && isset($_GET["start_date"])) {
    require 'connect.php';
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