<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khóa Học</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/courses.css">
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
                    <span>Đăng Ký</span>
                    <ul class="submenu">
                        <li><a href="./enroll/input-enrolls.php">Đăng Ký</a></li>
                        <li><a href="./enroll/table-enrolls.php">Danh Sách</a></li>
                        <li><a href="./enroll/find-enroll.php">Tìm Kiếm</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") { ?>
                    <li>
                        <span>Khóa học</span>
                        <ul class="submenu">
                            <li><a href="input-courses.php">Tạo Khóa Học</a></li>
                            <li><a href="table-courses.php">Danh Sách</a></li>
                            <li><a href="find-courses.php">Tìm Kiếm</a></li>
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
    <!-- Tạo Khóa học -->
    <div class="container">
        <a href="../fields/input-fields.php">Thêm Lĩnh Vực</a>
        <form action="" method="post">
            <h2>Tạo Khóa học</h2>
            <label for="course_id">Mã Khóa Học:</label><br>
            <input type="text" name="course_id" id="course_id" required><br>

            <label for="courses_img">Ảnh Khóa Học:</label><br>
            <input type="url" name="course_img" id="course_img" required><br>

            <label for="course_name">Tên Khóa Học:</label><br>
            <input type="text" name="course_name" id="course_name" required><br>

            <label for="sub_title">Tiêu đề phụ:</label><br>
            <input type="text" name="sub_title" id="sub_title" required><br>

            <label for="fields">Lĩnh Vực:</label><br>
            <select name="field_id" id="fields">
                <?php
                require '../connect.php';
                $sql = "SELECT * FROM fields";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
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
            <label for="lesson_count">Số bài học:</label><br>
            <input type="number" name="lesson_count" id="lesson_count" required><br>

            <label for="duration">Thời gian học:</label><br>
            <input type="text" name="duration" id="duration" required><br>

            <label for="fee">Học Phí:</label><br>
            <input type="text" name="fee" id="fee" required><br>

            <p>
                Mô tả khóa học:
            </p>

            <label for="target_learn">Đối tượng học:</label><br>
            <textarea name="target_learn" id="target_learn" required></textarea><br>

            <label for="benefit">Những gì bạn sẽ học được:</label><br>
            <textarea name="benefit" id="benefit" required></textarea><br>

            <label for="description">Mô tả khóa học:</label><br>
            <textarea name="description" id="description" required></textarea><br>

            <input type="submit" value="Tạo khóa học">
            </select>
        </form>
    </div>
</body>

</html>
<?php
if (
    isset($_POST["course_id"]) && isset($_POST["course_img"]) && isset($_POST["course_name"]) && isset($_POST["field_id"]) && isset($_POST["lesson_count"])  && isset($_POST["duration"])
    && isset($_POST["target_learn"]) && isset($_POST["benefit"]) && isset($_POST["description"]) && isset($_POST["fee"])
) {
    require '../connect.php';
    // table courses
    $course_id = $_POST["course_id"];
    $course_name = $_POST["course_name"];
    $field_id = $_POST["field_id"];
    $lesson_count = $_POST["lesson_count"];
    $duration = $_POST["duration"];
    $fee = $_POST["fee"];
    $course_img = $_POST["course_img"];

    //table detail_courses
    $sub_title = $_POST['sub_title'];
    $benefit = $_POST['benefit'];
    $target_learn = $_POST['target_learn'];
    $description = $_POST['description'];

    $check_sql = "SELECT * FROM courses WHERE course_id = '$course_id' AND course_name = '$course_name'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        // Nếu đã tồn tại
        echo "<script>alert('Bạn đã tạo khóa học này rồi!');</script>";
    } else {
        $sql1 = "INSERT INTO courses(course_id,course_name,field_id,lesson_count,duration,fee,course_img)
            VALUE ('$course_id','$course_name','$field_id','$lesson_count','$duration','$fee','$course_img')";


        $sql2 = "INSERT INTO detail_courses(course_id,sub_title,benefit,target_learn,description)
            VALUE ('$course_id','$sub_title','$benefit','$target_learn','$description') ";
        //check xem đã nhập thông tin và ok hay chưa
        if ($conn->query($sql1) === True && $conn->query($sql2) === True) {
            echo "<script>alert('Tạo khóa học thành công!');</script>";
        } else {
            echo "Error form table courses: " . $sql1 . "<br>" . $conn->error;
            echo "Error from table courses: " . $sql2 . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>