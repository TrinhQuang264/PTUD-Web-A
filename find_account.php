<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="find_account.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['email'] && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <nav class="navbar">
                <ul>
                    <li class="homepage"><a href="index.php">Trang Chủ</a></li>
                    <li class="find"><a href="account_manager.php">Quản Lý Tài Khoản</a></li>
                </ul>
            </nav>
            <div class="logout">
                <?php
                echo "<a href='logout.php'>Đăng Xuất</a>";
                ?>
            </div>
        </header>

        <aside>
            <div class="info">
                <p>Vai Trò</p>
                <p>Admin</p>
                <p>(Quản Trị Viên)</p>
            </div>
        </aside>
        <main>
            <div class="container">
                <form action="" method="GET">
                    <h2>Tìm Kiếm</h2>
                    <!-- <p>ID</p>
                    <input type="number" name="account_id" placeholder="Tìm Kiếm Theo ID"><br>
                    <p>Họ và Họ Đệm:</p>
                    <input type="text" name="last_name" placeholder="Tìm Kiếm Theo Họ và Họ Đệm"><br>-->
                    <p>Tên:</p>
                    <input type="text" name="first_name" placeholder="Tìm Kiếm Theo Tên"><br>
                    <!-- <p>Email:</p>
                    <input type="email" name="email" placeholder="Tìm Kiếm Theo Email"><br> -->
                    <!-- <p>Quyền:</p>
                    <select name="role_id" value="<?php echo $row["role_id"]; ?>"><br>
                         <?php
                            // require 'connect.php';
                            // $sql = "SELECT * FROM role";
                            // $result = $conn->query($sql);
                            // if ($result->num_rows > 0) {
                            //     for ($i = 0; $i < $result->num_rows; $i++) {
                            //         $row = $result->fetch_assoc();
                            //         $role_id = $row["role_id"];
                            //         $role_name = $row["role_name"];
                            //         echo "<option value='$role_id'>" . $row["role_name"] . "</option>";
                            //     }
                            // }
                            // $conn->close();
                            ?> 
                    </select><br> -->
                    <input type="submit" value="Tìm Kiếm" class="submit-button" name="submit"><br>
                </form>
            </div>
            <?php
            if (isset($_GET["submit"])) {
                require 'connect.php';
                mysqli_set_charset($conn, 'UTF8');
                $account_id = isset($_GET['account_id']);
                $last_name = isset($_GET['last_name']);
                $first_name = isset($_GET['first_name']);
                $email = isset($_GET['email']);
                $role_id = isset($_GET['role_id']);
                $sql = "SELECT a.account_id,a.last_name,a.first_name,a.email,a.password,r.role_name
                    FROM account a
                    INNER JOIN role r On  a.role_id = r.role_id Where first_name ='$first_name'";


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class='show-find-table'>";
                    echo "<table>
                        <p> Bảng thông tin </p>
                        <tr>
                            <th>ID</th>
                            <th>Họ và Họ Đệm</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Quyền</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["account_id"] . "</td>" .
                            "<td>" . $row["last_name"] . "</td>" .
                            "<td>" . $row["first_name"] . "</td>" .
                            "<td>" . $row["email"] . "</td>" .
                            "<td>" . $row["role_name"] . "</td>";
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
        }
        ?>
</body>

</html>