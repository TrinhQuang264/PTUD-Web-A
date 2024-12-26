<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/account_manager.css" />
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
    <main>
        <?php
        require '../connect.php';
        mysqli_set_charset($conn, 'UTF8');
        // role người dùng
        if (isset($_SESSION['email']) && $_SESSION['role_id'] == "user") {
        ?>
            <div class="table-view">
                <h2>Danh Sách Đăng Ký Học</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Khóa Học</th>
                        <th>Thời Gian Đăng Ký</th>
                        <th>Tính năng</th>
                    </tr>
                    <?php
                    $user_email = $_SESSION['email'];

                    $sql = "SELECT id,enroll_name,enroll_email,enroll_phone,course_name,enroll_date
                                 FROM enrolls e
                                INNER JOIN  courses c On  e.course_id = c.course_id
                                WHERE e.enroll_email = '$user_email'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                            $id = $row["id"];
                            $enroll_email = $row["enroll_email"];
                            echo "<tr style='background-color: $bgColor;'>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["course_name"] . "</td>";
                            echo "<td>" . $row["enroll_date"] . "</td>";
                            // icon của phần tính năng
                            // tính năng xóa 
                            echo "<td>" . " <a href='delete-enroll.php?id=" . $id . "' title ='Xóa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                </svg>
                                            </a>";
                            // tính năng Sửa 
                            echo  " <a href='change-enroll.php?enroll_email=" . $enroll_email . "' title ='Sửa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                        <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                                    </svg>
                                                </a>" .
                                "</td>";
                            echo "</tr>";
                        }
                    }
                } else if (isset($_SESSION['email']) && $_SESSION['role_id'] == 'admin') {
                    ?>
                    <div class="table-view">
                        <h2>Danh Sách Đăng Ký Học</h2>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Tên khóa học</th>
                                <th>Ngày và giờ đăng ký</th>
                                <th>Tính năng</th>
                            </tr>
                        <?php
                        $sql = "SELECT id,enroll_name,enroll_email,enroll_phone,course_name,enroll_date
                                FROM enrolls e
                                INNER JOIN  courses c On  e.course_id = c.course_id;";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                                $id = $row["id"];
                                $enroll_email = $row["enroll_email"];
                                echo "<tr style='background-color: $bgColor;'>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["enroll_name"] . "</td>";
                                echo "<td>" . $row["enroll_email"] . "</td>";
                                echo "<td>" . $row["enroll_phone"] . "</td>";
                                echo "<td>" . $row["course_name"] . "</td>";
                                echo "<td>" . $row["enroll_date"] . "</td>";
                                // icon của phần tính năng
                                // tính năng xóa 
                                echo "<td>" . " <a href='delete-enroll.php?id=" . $id . "' title ='Xóa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                    </svg>
                                                </a>";
                                // tính năng Sửa 
                                echo  " <a href='change-enroll.php?enroll_email=" . $enroll_email . "' title ='Sửa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                                        </svg>
                                                    </a>" .
                                    "</td>";
                                echo "</tr>";
                            }
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