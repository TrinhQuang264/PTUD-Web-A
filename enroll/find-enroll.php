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
    <header class="header">
        <!-- Logo -->
        <div class="logo">
            <a href="../index.php">COURSE</a>
        </div>
        <?php
        session_start();
        require '../connect.php';
        if (isset($_SESSION['email'])) { ?>


            <!-- Menu -->
            <ul class="main-menu">
                <li>
                    <span>Khóa Học Của Bạn</span>
                    <ul class="submenu">
                        <li><a href="table-enrolls.php">Danh Sách</a></li>
                        <li><a href="find-enroll.php">Tìm Kiếm</a></li>
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
    <main class="container">
        <div class="find__box">
            <?php
            if (isset($_SESSION['email']) && $_SESSION['role_id'] == "user") {
            ?>
                <h2>Tìm Kiếm:</h2>
                <form action="" name="find_from" method="get">

                    <label for="id" class='row'>ID:</label><br>
                    <input type="text" name="id" id="id"><br>

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
                                $row_field = $result->fetch_assoc();
                                $field_id = $row_field["field_id"];
                                $field_name = $row_field["field_name"];

                                echo "<option value='$field_id' selected>" . $row_field["field_name"] . "</option>";
                            }
                        }

                        ?>
                    </select><br>

                    <input type="submit" name="submit" value="Tìm Kiếm">
                </form>
            <?php
            } else if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
                <h2>Tìm Kiếm:</h2>
                <form action="" name="find_from" method="get">
                    <label for="id" class='row'>ID:</label><br>
                    <input type="text" name="id" id="id"><br>
                    <label for="enroll_name" class='row'>Họ và Tên:</label><br>
                    <input type="text" name="enroll_name" id="enroll_name"><br>

                    <label for="enroll_email" class='row'>Email:</label><br>
                    <input type="text" name="enroll_email" id="enroll_email"><br>

                    <label for="enroll_phone" class='row'>Số Điện Thoại:</label><br>
                    <input type="text" name="enroll_phone" id="enroll_phone"><br>

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
                                $row_field = $result->fetch_assoc();
                                $field_id = $row_field["field_id"];
                                $field_name = $row_field["field_name"];

                                echo "<option value='$field_id' selected>" . $row_field["field_name"] . "</option>";
                            }
                        }

                        ?>
                    </select><br>
                    <input type="submit" name="submit" value="Tìm Kiếm">
                </form>
            <?php
            }
            ?>
        </div>


        <div class="result__find">
            <?php

            if (isset($_SESSION['email']) && $_SESSION['role_id'] == "user") {

                $email_account = $_SESSION['email'];
                $sql = "SELECT c.*, e.*, f.field_name
                        FROM courses c
                        INNER JOIN enrolls e ON c.course_id = e.course_id
                        INNER JOIN fields f ON c.field_id = f.field_id
                        WHERE e.enroll_email = '$email_account'";


                if (isset($_GET['course_name']) && $_GET['course_name'] != "") {
                    $course_name = $_GET['course_name'];
                    $sql .= " AND c.course_name LIKE '%$course_name%'";
                }
                if (isset($_GET['field_id']) && $_GET['field_id'] != "") {
                    $field_id = $_GET['field_id'];
                    $sql .= " AND c.field_id = '$field_id'";
                }
                if (isset($_GET['id']) && $_GET['id'] != "") {
                    $id = $_GET['id'];
                    $sql .= " AND e.id = '$id'";
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<div class='table-view'> 
                            <h2>Thông Tin được tìm kiếm:</h2> 
                                <table> 
                                    <tr> 
                                        <th>ID</th>
                                        <th>Tên khóa học</th> 
                                        <th>Ngày và giờ đăng ký</th>
                                    </tr>";
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                        echo "<tr style='background-color: $bgColor;'>
                                <td>" . $row["id"] . "</td> 
                                <td>" . $row["course_name"] . "</td> 
                                <td>" . $row["enroll_date"] . "</td> 
                             </tr>";
                    }
                    echo "</table>
                        </div>";
                } else {
                    echo "<tr><td colspan='6' text-align='center'>Chưa có dữ liệu! Vui lòng Nhập để Hiện thị</td></tr>";
                }
                $conn->close();
            } else if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {

                $sql = "SELECT c.*, e.*, f.field_name
                        FROM courses c
                        INNER JOIN enrolls e ON c.course_id = e.course_id
                        INNER JOIN fields f ON c.field_id = f.field_id
                        WHERE 1";


                if (isset($_GET['course_name']) && $_GET['course_name'] != "") {
                    $course_name = $_GET['course_name'];
                    $sql .= " AND c.course_name LIKE '%$course_name%'";
                }
                if (isset($_GET['field_id']) && $_GET['field_id'] != "") {
                    $field_id = $_GET['field_id'];
                    $sql .= " AND c.field_id = '$field_id'";
                }
                if (isset($_GET['id']) && $_GET['id'] != "") {
                    $id = $_GET['id'];
                    $sql .= " AND e.id = '$id'";
                }
                if (isset($_GET['enroll_name']) && $_GET['enroll_name'] != "") {
                    $enroll_name = $_GET['enroll_name'];
                    $sql .= " AND e.enroll_name LIKE '%$enroll_name%'";
                }
                if (isset($_GET['enroll_email']) && $_GET['enroll_email'] != "") {
                    $enroll_email = $_GET['enroll_email'];
                    $sql .= " AND e.enroll_email='$enroll_email'";
                }
                if (isset($_GET['enroll_phone']) && $_GET['enroll_phone'] != "") {
                    $enroll_phone = $_GET['enroll_phone'];
                    $sql .= " AND e.enroll_phone='$enroll_phone'";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<div class='table-view'> 
                                    <h2>Thông Tin được tìm kiếm:</h2> 
                                        <table> 
                                            <tr> 
                                                <th>ID</th>
                                                <th>Họ và Tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Tên khóa học</th> 
                                                <th>Ngày và giờ đăng ký</th>
                                            </tr>";
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                        echo "<tr style='background-color: $bgColor;'>
                                        <td>" . $row["id"] . "</td> 
                                        <td>" . $row["enroll_name"] . "</td> 
                                        <td>" . $row["enroll_email"] . "</td> 
                                        <td>" . $row["enroll_phone"] . "</td>
                                        <td>" . $row["course_name"] . "</td> 
                                        <td>" . $row["enroll_date"] . "</td> 
                                     </tr>";
                    }
                    echo "</table>
                                </div>";
                } else {
                    echo "<tr><td colspan='6' text-align='center'>Chưa có dữ liệu! Vui lòng Nhập để Hiện thị</td></tr>";
                }
                $conn->close();
            }
            ?>
            </table>
        </div>
    </main>
</body>

</html>