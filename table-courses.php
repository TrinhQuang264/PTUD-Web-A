<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Chủ</title>
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
        <main>
            <div class="table-view">
                <h2>Danh Sách Khóa Học</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Tên Khóa Học</th>
                        <th>Phân Loại</th>
                        <th>Bài Học</th>
                        <th>Thời Gian Học</th>
                        <th>Học Phí</th>
                        <th>Bắt Đầu Học</th>
                    </tr>
                    <?php
                    require 'connect.php';
                    mysqli_set_charset($conn, 'UTF8');

                    $sql = "SELECT course_id,course_name,d.difficulty_name,lesson_count,duration,fee, start_date         
                        FROM  courses c
                        INNER JOIN  difficult d On  c.difficulty_id = d.difficulty_id;";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                            $course_id = $row["course_id"];
                            echo "<tr style='background-color: $bgColor;'>";
                            echo "<td>" . $row["course_id"] . "</td>";
                            echo "<td>" . $row["course_name"] . "</td>";
                            echo "<td>" . $row["difficulty_name"] . "</td>";
                            echo "<td>" . $row["lesson_count"] . "</td>";
                            echo "<td>" . $row["duration"] . "</td>";
                            echo "<td>" . $row["fee"] . "</td>";
                            echo "<td>" . $row["start_date"] . "</td>";

                            // icon của phần tính năng
                            // tính năng xóa 
                            echo "<td>" . " <a href='delete-courses.php?course_id=" . $course_id . "' title ='Xóa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                </svg>
                                            </a>";
                            // tính năng Sửa 
                            echo  " <a href='change-courses.php?course_id=" . $course_id . "' title ='Sửa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                        <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                                    </svg>
                                                </a>" .
                                "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo  "<tr><td colspan='6' text-align='center'>Chưa có dữ liệu! Vui lòng Nhập để Hiện thị</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
        </main>
</body>

</html>