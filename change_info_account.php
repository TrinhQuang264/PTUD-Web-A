<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tài Khoản</title>
</head>
<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
    }

    /*Phần Nav bar*/
    .header {
        position: sticky;
        background-color: lightblue;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
    }

    ul,
    li,
    .logout {
        list-style: none;
        font-size: 15px;
        font-weight: bold;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        color: red;
    }

    .navbar ul li {
        display: inline-block;
        padding-left: 20px;
    }

    .logout {
        margin-right: 20px;
    }

    /*Phần aside tính năng*/
    aside {
        background-color: aquamarine;
        position: fixed;
        top: 60px;
        left: 0;
        bottom: 0;
        width: 180px;
        height: 100%;
    }

    aside p {
        text-align: center;
        margin-top: 3px;
        margin-bottom: 3px;
    }

    p:nth-child(1) {
        margin-top: 5px;
        font-size: 20px;
        font-weight: bold;
        border-bottom: 1px solid #0056b3;
    }

    p:nth-child(2) {
        font-weight: bold;
        margin: 0;
    }

    p:nth-child(3) {
        margin: 0;
        font-size: 14px;
    }

    main {
        position: relative;
    }

    .container {
        position: absolute;
        left: 180px;
        top: 20px;
        width: 1275px;
    }

    .no-change {
        font-size: 15px;
        margin-left: 470px;
        margin-top: 10px;
    }

    form {
        text-align: left;
        align-content: center;
        width: 215px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
        padding: 10px;
        margin-left: 500px;
    }

    form h2 {
        font-size: 15px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    form p {
        text-align: left;
        margin-bottom: 0px;
        font-weight: 400;
        font-size: 12px;
    }

    form input {
        width: 190px;
        margin-top: 0px;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 3px;
        border: 1px solid gray;
        outline: none;
    }

    form input:focus {
        border: 1px solid #32f645;
    }

    form .submit-button {
        margin-top: 10px;
        margin-bottom: 20px;
        border: none;
        background-color: #92fe9d;
        color: #155724;
        font-weight: 700;
        width: 190px;
        margin-left: 5px;
    }

    form .submit-button:hover {
        background: white;
        color: #32f645;
        border: 2px solid #92fe9d;
    }

    form .submit-button:active {
        opacity: 0.3;
    }
</style>

<body>
    <?php
    session_start();
    if ($_SESSION['email'] && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <nav class="navbar">
                <ul>
                    <li class="homepage"><a href="index.php">Trang Chủ</a></li>
                    <li class="find"><a href="find_account.php">Tìm Kiếm</a></li>
                </ul>
            </nav>
            <div class="logout">
                <?php
                echo "<a href='logout.php'>Đăng Xuất</a>";
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
            require 'connect.php';
            $sql = "SELECT * FROM account WHERE account_id='$account_id'";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="container">
                <form action="" method="post">
                    <h2>Sửa Thông Tin</h2>
                    <p>ID</p>
                    <input type="number" name="account_id" value="<?php echo $account_id; ?>" readonly><br>
                    <p>Họ và Họ Đệm:</p>
                    <input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>"><br>
                    <p>Tên:</p>
                    <input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>"><br>
                    <p>Email:</p>
                    <input type="text" name="email" value="<?php echo $row["email"]; ?>"><br>
                    <p>Mật Khẩu:</p>
                    <input type="text" name="password" value="<?php echo $row["password"]; ?>"><br>
                    <p>Quyền:</p>
                    <select name="role_id" value="<?php echo $row["role_id"]; ?>"><br>
                        <?php
                        require 'connect.php';
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
                <button class="back-to-login-button"><a href="login.php">Quay lại trang đăng nhập</a></button>
            </div>
        </div>
    <?php
    }
    ?>
    </div>

</body>

</html>
<?php
if (isset($_POST["account_id"]) && isset($_POST["last_name"]) && isset($_POST["first_name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["role_id"])) {
    require 'connect.php';
    $account_id = $_POST["account_id"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $role_id = $_POST["role_id"];
    mysqli_set_charset($conn, 'UTF8');
    $sql = "UPDATE account SET account_id = '$account_id', last_name = '$last_name', first_name = '$first_name', password = '$password', email = '$email', role_id = '$role_id' 
            WHERE account_id= '$account_id'";
    if ($conn->query($sql) == True) {
        echo " Đã thay đổi";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>