<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tìm Kiếm Thông Tin</title>
    <link rel="stylesheet" href="home-page.css" />
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

    form {
        text-align: left;
        align-content: center;
        width: 205px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
        padding: 10px;
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
        padding: 5px;
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

    /*Chỉnh Table */
    table,
    td,
    th {
        border: 3px solid black;
        border-collapse: collapse;
    }

    th {
        background-color: #00c9ff;
    }

    td,
    th {
        text-align: center;
        padding: 4px;
        font-size: 20px;
    }

    svg {
        margin-left: 5px;
        margin-right: 5px;
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
        <main>
            <form action="">
                <h2>Tìm Khóa học đăng có </h2>
                <p>Họ và Tên:</p>
                <input type="text" name="enroll_name" required>
                <input type="submit" value="Gửi">
        </main>
        <?php
        if (isset($_GET["enroll_name"])) {
            require 'connect.php';
            mysqli_set_charset($conn, 'UTF8');
            $enroll_name = $_GET['enroll_name'];

            $sql = "SELECT enroll_id,enroll_name,enroll_email,enroll_phone,course_name,enroll_date
                FROM enrolls e
               INNER JOIN  courses c On  e.course_id = c.course_id WHERE enroll_name = '$enroll_name'";


            $result = $conn->query($sql);

            if ($result != false && $result->num_rows > 0) {
                echo "<div class='show-find-table'>";
                echo "<table>
                        <p> Bảng thông tin </p>
                        <tr>
                            <th>ID</th>
                            <th>Họ và Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Khóa Học</th>
                            <th>Thời Gian Đăng Kí</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["enroll_id"] . "</td>" .
                        "<td>" . $row["enroll_name"] . "</td>" .
                        "<td>" . $row["enroll_email"] . "</td>" .
                        "<td>" . $row["enroll_phone"] . "</td>" .
                        "<td>" . $row["course_name"] . "</td>" .
                        "<td>" . $row["enroll_date"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='no-respon'>Không Tìm Thấy dữ liệu!<p>";
            }

            $conn->close();
        ?>
        <?php
        }

        ?>
</body>

</html>