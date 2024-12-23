<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tìm Kiếm Thông Tin</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../index.css" />
</head>
<style>
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
                        <li><a href="input-enrolls.php">Đăng Ký</a></li>
                        <li><a href="table-enrolls.php">Danh Sách</a></li>
                        <li><a href="find-enroll.php">Tìm Kiếm</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
                    <li>
                        <span>Khóa học</span>
                        <ul class="submenu">
                            <li><a href="../courses/input-courses.php">Tạo Khóa Học</a></li>
                            <li><a href="../courses/table-courses.php">Danh Sách</a></li>
                            <li><a href="../courses/find-courses.php">Tìm Kiếm</a></li>
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
    <main>
        <form action="">
            <h2>Tìm Khóa học đăng có </h2>
            <p>Họ và Tên:</p>
            <input type="text" name="enroll_name" required>
            <input type="submit" value="Gửi">
    </main>
    <?php
    if (isset($_GET["enroll_name"])) {
        require '../connect.php';
        mysqli_set_charset($conn, 'UTF8');
        $enroll_name = $_GET['enroll_name'];

        $sql = "SELECT enroll_id,enroll_name,enroll_email,enroll_phone,c.course_name,enroll_date
                FROM enrolls e
               INNER JOIN  courses c On  e.course_id = c.course_id WHERE enroll_name = '$enroll_name'";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
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