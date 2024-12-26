<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Kí Khóa Học</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/form-resgister.css">
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
                    <span>Khóa Học Của Bạn</span>
                    <ul class="submenu">
                        <li><a href="../enroll/table-enrolls.php">Danh Sách</a></li>
                        <li><a href="../enroll/find-enroll.php">Tìm Kiếm</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
                    <li>
                        <span>Quản Lý Khóa học</span>
                        <ul class="submenu">
                            <li><a href="../courses/input-courses.php">Tạo Khóa Học</a></li>
                            <li><a href="../courses/table-courses.php">Danh Sách</a></li>
                            <li><a href="../courses/find-courses.php">Tìm Kiếm</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>Quản Lý Tài Khoản</span>
                        <ul class="submenu">
                            <li><a href="../account_manage/account_manager.php">Danh Sách</a></li>
                            <li><a href="../account_manage/find_account.php">Tìm Kiếm</a></li>
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
                        <span class="dropdown__text"><a href="../account_info.php">Thông Tin Tài Khoản</a></span>
                    </li>
                    <li class="dropdown__item">
                        <svg class="dropdown__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
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
    <?php
    $enroll_email = $_GET["enroll_email"];
    require '../connect.php';
    $sql = "SELECT * FROM enrolls WHERE enroll_email='$enroll_email'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <div class="container">
        <div class="box">
            <form action="" method="post">
                <h2>Đăng Kí Khóa học</h2>
                <div class="form_box--main">
                    <p>Họ và Tên:</p>
                    <input type="text" name="enroll_name" value="<?php echo $row["enroll_name"]; ?>" readonly>
                    <p>Email:</p>
                    <input type="email" name="enroll_email" value="<?php echo $row["enroll_email"]; ?>" readonly>
                    <p>Số Điện Thoại: </p>
                    <input type="text" name="enroll_phone" value="<?php echo $row["enroll_phone"]; ?>">
                    <p>Tên Khóa học:</p>
                    <select name="course_id" value="<?php echo $row["course_id"]; ?>">
                        <?php
                        require '../connect.php';
                        $sql = "SELECT * FROM courses";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $course_id = $row["course_id"];
                                $course_name = $row["course_name"];
                                echo "<option value='$course_id'selected>" . $row["course_name"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <input type="submit" value="Gửi">
                <h3 class="no-change">Không muốn chỉnh sửa thì ấn <a href="table-enrolls.php">Quay Lại</a> đây!</h3>
            </form>
        </div>
    </div>

</body>

</html>
<?php
if (isset($_POST["enroll_name"]) && isset($_POST["enroll_email"]) && isset($_POST["enroll_phone"]) && isset($_POST["course_id"])) {
    require '../connect.php';
    $enroll_name = $_POST["enroll_name"];
    $enroll_email = $_POST["enroll_email"];
    $enroll_phone = $_POST["enroll_phone"];
    $course_id = $_POST["course_id"];

    mysqli_set_charset($conn, 'UTF8');
    $sql = "UPDATE enrolls SET enroll_name = '$enroll_name', enroll_email = '$enroll_email', enroll_phone = '$enroll_phone', course_id = '$course_id'
            WHERE enroll_email = '$enroll_email'";
    if ($conn->query($sql) === True) {
        echo "đã thêm thành công";
        echo "<script>alert('Bạn đã sửa thông tin thành công');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>