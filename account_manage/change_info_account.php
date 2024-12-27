<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tài Khoản</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/form-resgister.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['email'] && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <!-- Logo -->
            <div class="logo">
                <a href="index.php">COURSE</a>
            </div>
            <?php

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
                            <span>Quản Lý Tài Khoản</span>
                            <ul class="submenu">
                                <li><a href="account_manager.php">Danh Sách</a></li>
                                <li><a href="find_account.php">Tìm Kiếm</a></li>
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
        <!--Phần Body Chỉnh Sửa Thông TIn -->
        <main>
            <?php
            $account_id = $_GET["account_id"];
            require '../connect.php';
            $sql = "SELECT * FROM account WHERE account_id='$account_id'";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="container">
                <div class="box">
                    <form action="" method="post">
                        <h2>Sửa Thông Tin</h2>
                        <p>ID</p>
                        <input type="number" name="account_id" value="<?php echo $account_id; ?>" readonly><br>
                        <p>Họ và Tên:</p>
                        <input type="text" name="fullname" value="<?php echo $row["fullname"]; ?>"><br>
                        <p>Email:</p>
                        <input type="text" name="email" value="<?php echo $row["email"]; ?>"><br>
                        <p>Mật Khẩu:</p>
                        <input type="text" name="password" value="<?php echo $row["password"]; ?>"><br>
                        <p>Số điện thoại:</p>
                        <input type="text" name="phone" value="<?php echo $row["phone"]; ?>"><br>
                        <p>Quyền:</p>
                        <select name="role_id"><br>
                            <?php
                            require '../connect.php';
                            $sql = "SELECT * FROM role";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row_acc = $result->fetch_assoc()) {
                                    $role_id = $row_acc["role_id"];
                                    $role_name = $row_acc["role_name"];


                                    $selected = ($role_id == $row["role_id"]) ? "selected" : "";
                                    echo "<option value='$role_id' $selected>$role_name</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select><br>
                        <input type="submit" value="Cập Nhật" class="submit-button"><br>
                        <h3 class="no-change">Không muốn chỉnh sửa thì ấn <a href="account_manager.php">Quay Lại</a> đây!</h3>
                    </form>
                </div>
            </div>
        </main>
    <?php
    } else {
    ?>
        <div class="card--nou">
            <div class="nou-no-admin">
                <h2 id=>Không có quyền truy cập</h2>
                <p style="color:rgb(175, 136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
                <button class="back-to-login-button"><a href="../index.php">Quay lại trang chủ</a></button>
            </div>
        </div>
    <?php
    }
    ?>
    </div>

</body>

</html>
<?php
if (isset($_POST["account_id"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["role_id"]) && isset($_POST["phone"])) {
    require '../connect.php';
    $account_id = $_POST["account_id"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $role_id = $_POST["role_id"];
    $phone = $_POST["phone"];
    mysqli_set_charset($conn, 'UTF8');
    $sql = "UPDATE account SET account_id = '$account_id', fullname = '$fullname', password = '$password', email = '$email', role_id = '$role_id' , phone = '$phone'
            WHERE account_id= '$account_id'";
    if ($conn->query($sql) == True) {
        echo " Đã thay đổi";
        echo "<script>alert('Bạn đã sửa thành công!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>