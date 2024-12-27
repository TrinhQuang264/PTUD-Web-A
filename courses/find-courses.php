<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tìm Kiếm Thông Tin</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/courses.css" />
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['role_id'] != 'admin') {
    ?>
        <div class="card--nou">
            <div class="nou-no-admin">
                <h2>Không có quyền truy cập</h2>
                <p style="color:rgb(175, 136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
                <button class="back-to-login-button"><a href="../index.php">Quay lại trang chủ</a></button>
            </div>
        </div>
    <?php
    }

    if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
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
                                <li><a href="input-courses.php">Tạo Khóa Học</a></li>
                                <li><a href="table-courses.php">Danh Sách</a></li>
                                <li><a href="find-courses.php">Tìm Kiếm</a></li>
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
        }
        ?>
        </header>

        <main class="container">
            <div class="find__box">
                <h2>Tìm Kiếm:</h2>
                <form action="" name="find_from">
                    <label for="course_name" class='row'>Tên Khóa Học:</label><br>
                    <input type="text" name="course_name" id="course_name"><br>

                    <label for="choose_fields" class='row'>Phân Loại Lĩnh Vực:</label><br>
                    <select name="field_id" id="choose_fields">
                        <?php
                        require '../connect.php';
                        $sql = "SELECT * FROM fields";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<option value=''>Tất cả</option>";
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $field_id = $row["field_id"];
                                $field_name = $row["field_name"];

                                echo "<option value='$field_id' selected>" . $row["field_name"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select><br>
                    <input type="submit" name="submit" value="Tìm Kiếm">
                </form>
            </div>

            <div class="result__find">
                <div class="list_courses">
                    <div class="template_course">
                        <?php
                        if (isset($_GET['submit'])) {
                            require '../connect.php';

                            $sql = "SELECT c.*, d.*, f.field_name
                                    FROM courses c
                                    INNER JOIN detail_courses d ON c.course_id = d.course_id
                                    INNER JOIN fields f ON c.field_id = f.field_id 
                                    WHERE 1 ";

                            if (isset($_GET['course_name']) && $_GET['course_name'] != "") {
                                $course_name = $_GET['course_name'];
                                $sql .= " AND course_name LIKE '%$course_name%'";
                            }

                            if (isset($_GET['field_id']) && $_GET['field_id'] != "") {
                                $field_id = $_GET['field_id'];
                                $sql .= " AND c.field_id = '$field_id'";
                            }


                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='grid_item'>";
                                    echo "<img class='grid_item-img' src = '" . $row["course_img"] . "' alt = 'Ảnh Khóa Học " . $row["course_name"] . "' >";
                                    echo "<div class='grid_item-box'>";
                                    echo    "<h3 class='grid_item-name'>" . "<span class='fields'>" . $row['field_name'] . "</span>" . " " . $row["course_name"] . "</h3>";
                                    echo    "<p class='grid_item-sub'>" . $row['sub_title'] . "</p>";
                                    echo    "<p class='grid_item-price'>" . $row["fee"] . "<span> VND</span>" . "</p>";
                                    echo    "<a href='../detail_courses.php?course_id=" . $row['course_id'] . "'>
                                                <button class='hover-button'>                   
                                                    Xem chi tiết                        
                                                </button> 
                                            </a>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "Không tìm thấy khóa học nào.";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
</body>

</html>