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
        <?php
        $course_id = $_GET["course_id"];
        require 'connect.php';
        $sql = "SELECT * FROM courses WHERE course_id='$course_id'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <form action="" method="get">
            <p>Mã Khóa Học:</p>
            <input type="text" name="course_id" value="<?php echo $course_id; ?> " readonly>
            <p>Tên Khóa Học:</p>
            <input type="text" name="course_name" value="<?php echo $row["course_name"]; ?>">
            <p>Phân loại</p>
            <select name="difficulty_id" value="<?php echo $row["difficulty_id"]; ?>">
                <?php
                require 'connect.php';
                $sql = "SELECT * FROM difficult";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row_d = $result->fetch_assoc();
                        $difficulty_id = $row_d["difficulty_id"];
                        $difficulty_name = $row_d["difficulty_name"];
                        echo "<option value='$difficulty_id' selected>" . $row_d["difficulty_name"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
            <p>Số Bài Học:</p>
            <input type="number" name="lesson_count" value="<?php echo $row["lesson_count"]; ?>">
            <p>Thời Gian Học:</p>
            <input type="text" name="duration" id="" value="<?php echo $row["duration"]; ?>">
            <p>Học Phí:</p>
            <input type="text" name="fee" value="<?php echo $row["fee"]; ?>">
            <p>Ngày Bắt Đầu:</p>
            <input type="text" name="start_date" value="<?php echo $row["start_date"]; ?>">
            <input type="submit" value="Gửi">
        </form>
        <h2 class="no-change">Không muốn chỉnh sửa thì ấn <a href="table-courses.php">Quay Lại</a> đây!</h2>
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

    mysqli_set_charset($conn, 'UTF8');
    $sql = "UPDATE courses SET course_name = '$course_name', difficulty_id = '$difficulty_id', lesson_count = '$lesson_count', duration = '$duration', fee = '$fee' ,start_date ='$start_date'
            WHERE course_id = '$course_id'";
    if ($conn->query($sql) === True) {
        echo "đã thêm thành công";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>