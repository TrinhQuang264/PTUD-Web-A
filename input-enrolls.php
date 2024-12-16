<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Kí Khóa Học</title>
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
        <div class="logo"><a href="index.php">COURSE</a></div>
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
        <form action="" method="post">
            <h2>Đăng Kí Khóa học</h2>
            <p>Họ và Tên:</p>
            <input type="text" name="enroll_name" value="<?php echo $_SESSION['last_name'] . " " . $_SESSION['first_name']; ?>" required>
            <p>Email:</p>
            <input type="email" name="enroll_email" value="<?php echo $_SESSION['email']; ?>">
            <p>Số Điện Thoại: </p>
            <input type="text" name="enroll_phone" id="" required selected>
            <p>Tên Khóa học:</p>
            <select name="course_id">
                <?php
                require 'connect.php';
                $sql = "SELECT * FROM courses";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $course_id = $row["course_id"];
                        $course_name = $row["course_name"];
                        echo "<option value='$course_id'>" . $row["course_name"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
            <input type="submit" value="Gửi">
        </form>
</body>

</html>
<?php
if (isset($_POST["enroll_name"]) && isset($_POST["enroll_email"]) && isset($_POST["enroll_phone"]) && isset($_POST["course_id"])) {
    require 'connect.php';
    $enroll_name = $_POST["enroll_name"];
    $enroll_email = $_POST["enroll_email"];
    $enroll_phone = $_POST["enroll_phone"];
    $course_id = $_POST["course_id"];

    $check_sql = "SELECT * FROM enrolls WHERE enroll_email = '$enroll_email' AND course_id = '$course_id'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        // Nếu đã tồn tại
        echo "<script>alert('Bạn đã đăng ký khóa học này rồi!');</script>";
    } else {

        $sql = "INSERT INTO enrolls(enroll_name,enroll_email,enroll_phone,course_id)
            VALUE ('$enroll_name','$enroll_email','$enroll_phone','$course_id')";

        //check xem đã nhập thông tin và ok hay chưa
        if ($conn->query($sql) === True) {
            echo "<script>alert('Đăng ký khóa học thành công!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>