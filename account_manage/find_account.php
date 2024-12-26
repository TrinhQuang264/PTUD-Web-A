<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/courses.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['email']) || $_SESSION['role_id'] != 'admin') {
    ?>
        <div class="card--nou">
            <div class="nou-no-admin">
                <h2 id=>Không có quyền truy cập</h2>
                <p style="color:rgb(175,  136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
                <button class="back-to-login-button"><a href="../index.php">Quay lại trang chủ</a></button>
            </div>
        </div>

    <?php
    }
    if (isset($_SESSION['email']) && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <!-- Logo -->
            <div class="logo">
                <a href="../index.php">COURSE</a>
            </div>
            <?php

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

        <main class="container">
            <div class="find__box">
                <h2>Tìm Kiếm</h2>
                <form action="" method="GET" name="find_from">
                    <p>ID</p>
                    <input type="number" name="account_id" placeholder="Tìm Kiếm Theo ID"><br>
                    <p>Họ và Tên:</p>
                    <input type="text" name="fullname" placeholder="Tìm Kiếm Theo Họ và Tên"><br>
                    <p>Email:</p>
                    <input type="email" name="email" placeholder="Tìm Kiếm Theo Email"><br>
                    <p>Số Điện Thoại:</p>
                    <input type="phone" name="phone" placeholder="Tìm Kiếm Theo Số Điện Thoại"><br>
                    <p>Quyền:</p>
                    <select name="role_id"><br>
                        <?php
                        require '../connect.php';
                        $sql = "SELECT * FROM role";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<option value=''>Tất cả</option>";
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $role_id = $row["role_id"];
                                $role_name = $row["role_name"];
                                echo "<option value='$role_id'>" . $row["role_name"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select><br>
                    <input type="submit" value="Tìm Kiếm" class="submit-button" name="submit"><br>
                </form>
            </div>
            <div class="result__find">

            <?php
            if (isset($_GET["submit"])) {
                require '../connect.php';
                mysqli_set_charset($conn, 'UTF8');
                $account_id = $_GET['account_id'];
                $fullname = $_GET['fullname'];
                $email = $_GET['email'];
                $phone = $_GET['phone'];
                $role_id = $_GET['role_id'];

                $sql = "SELECT a.*,r.role_name
                        FROM account a
                        INNER JOIN role r On  a.role_id = r.role_id 
                        Where 1";

                if (isset($_GET['account_id']) && $_GET['account_id'] != "") {
                    $sql .= " AND a.account_id = '$account_id'";
                }

                if (isset($_GET['fullname']) && $_GET['fullname'] != "") {
                    $sql .= " AND fullname LIKE '%$fullname%'";
                }

                if (isset($_GET['email']) && $_GET['email'] != "") {
                    $sql .= " AND a.email = '$email'";
                }
                if (isset($_GET['phone']) && $_GET['phone'] != "") {
                    $sql .= " AND a.phone = '$phone'";
                }
                if (isset($_GET['role_id']) && $_GET['role_id'] != "") {
                    $sql .= " AND a.role_id = '$role_id'";
                }


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class='table-views'>";
                    echo "<table>
                        <p> Bảng thông tin </p>
                        <tr>
                            <th>ID</th>
                            <th>Họ và Tên</th>                     
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Quyền</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["account_id"] . "</td>" .
                            "<td>" . $row["fullname"] . "</td>" .
                            "<td>" . $row["email"] . "</td>" .
                            "<td>" . $row["phone"] . "</td>" .
                            "<td>" . $row["role_name"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p class='no-respon'>Không Tìm Thấy dữ liệu!<p>";
                }
                $conn->close();
            }
        }
            ?>
            </div>
        </main>
</body>

</html>