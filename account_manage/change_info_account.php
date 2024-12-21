<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tài Khoản</title>
    <link rel="stylesheet" href="../css/change_info_manager.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['email'] && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <nav class="navbar">
                <ul>
                    <li class="homepage"><a href="../index.php">Trang Chủ</a></li>
                    <li class="find"><a href="./account_manage/find_account.php">Tìm Kiếm</a></li>
                </ul>
            </nav>
            <div class="logout">
                <?php
                echo "<a href='../logout.php'>Đăng Xuất</a>";
                ?>
            </div>
        </header>

        <aside>
            <div class="info">
                <p>Vai Trò</p>
                <p>Admin</p>
                <p>(Quản Trị Viên)</p>
            </div>
        </aside>
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
                    <p>Quyền:</p>
                    <select name="role_id" value="<?php echo $row["role_id"]; ?>"><br>
                        <?php
                        require '../connect.php';
                        $sql = "SELECT * FROM role";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $role_id = $row["role_id"];
                                $role_name = $row["role_name"];
                                echo "<option value='$role_id' selected>" . $row["role_name"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select><br>
                    <input type="submit" value="Cập Nhật" class="submit-button"><br>
                </form>
                <h2 class="no-change">Không muốn chỉnh sửa thì ấn <a href="account_manager.php">Quay Lại</a> đây!</h2>
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
if (isset($_POST["account_id"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["role_id"])) {
    require '../connect.php';
    $account_id = $_POST["account_id"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $role_id = $_POST["role_id"];
    mysqli_set_charset($conn, 'UTF8');
    $sql = "UPDATE account SET account_id = '$account_id', fullname = '$fullname', password = '$password', email = '$email', role_id = '$role_id' 
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