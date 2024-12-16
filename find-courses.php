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
                <button class="back-to-login-button"><a href="index.php">Quay lại trang chủ</a></button>
            </div>
        </div>
    <?php
    }

    if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
    ?>
        <header class="header">
            <div class="logo"><a href="index.php">COURSE</a></div>
        <?php
        echo "<div class='manager'> Vài trò: Quản Trị Viên</div>";
        echo "<nav class='navbar'>
                      <ul>
                        <li><a href='logout.php'>Đăng Xuất</a></li>
                      </ul>
                    </nav>";
    }
        ?>
        </header>

        <?php
        if (isset($_SESSION['email']) && $_SESSION['role_id'] == "admin") {
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

            </aside>


            <main>
                <form action="">
                    <h2>Tìm Khóa học đã đăng kí </h2>
                    <p>Phân Loại:</p>
                    <select name="difficulty_id">
                        <?php
                        require 'connect.php';
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
                require 'connect.php';
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
        }
        ?>
</body>

</html>