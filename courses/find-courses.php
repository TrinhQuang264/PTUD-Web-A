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

    .list_courses {
        margin-left: 10px;
        margin-right: 10px;
        height: auto;
    }

    .list_courses .template_course {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        margin-left: 60px;
        row-gap: 40px;
        column-gap: 20px;
    }

    .list_courses .grid_item {
        width: 280px;
        border-radius: 5px;
        padding: 5px;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.4);
        background-color: white;
    }

    .list_courses .grid_item-price {
        color: red;
        font-weight: 500;
    }
</style>

<body>
    <?php
    session_start();
    if (isset($_SESSION['email']) && $_SESSION['role_id'] != 'admin') {
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


        <main>
            <form action="">
                <h2>Tìm Khóa học đã đăng kí </h2>
                <p>Phân Loại:</p>
                <select name="difficulty_id">
                    <?php
                    require '../connect.php';
                    $sql = "SELECT * FROM difficult";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            $difficulty_id = $row["difficulty_id"];
                            $difficulty_name = $row["difficulty_name"];
                            echo "<option value='$difficulty_id'>" . $row["difficulty_name"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Gửi">
        </main>
        <?php
        if (isset($_GET["difficulty_id"])) {
            require '../connect.php';
            mysqli_set_charset($conn, 'UTF8');
            $difficulty_id = $_GET['difficulty_id'];

            echo "<div class='list_courses'>";
            echo "<div class='template_course'>";
            $sql = "SELECT course_id,course_name,d.difficulty_name,lesson_count,duration,fee, start_date         
                    FROM  courses c
                    INNER JOIN  difficult d On  c.difficulty_id = d.difficulty_id
                    WHERE c.difficulty_id ='$difficulty_id';";


            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    echo "<div class='grid_item'>";
                    echo "<h3 class='grid_item-name'>" . $row["course_name"] . " - " . $row["difficulty_name"] . "</h3>";
                    echo "<p class='grid_item-price'>" . $row["fee"] . "<span> VND</span>" . "</p>";
                    echo "<p class='grid_item-amount'> <b>Số Lượng:</b> " . $row["lesson_count"] . " Bài ~ " . trim($row["duration"]) . " Tháng" . "</p>";
                    echo "<p class='grid_item-date'><b>Ngày Bắt Đầu Học: </b>" . $row["start_date"] . "</p>";
                    echo "</div>";
                }
            }

            echo "</div>";
            echo "</div>";
        } else {
            echo "<p class='no-respon'>Không Tìm Thấy dữ liệu!<p>";
        }
        $conn->close();
        ?>
</body>

</html>