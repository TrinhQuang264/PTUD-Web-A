<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="../css/account_manager.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['email']) && $_SESSION['role_id'] === 'admin') {
    ?>
        <header class="header">
            <nav class="navbar">
                <ul>
                    <li class="homepage"><a href="../index.php">Trang Chủ</a></li>
                    <li class="find"><a href="find_account.php">Tìm Kiếm</a></li>
                </ul>
            </nav>
            <div class="logout">
                <?php
                echo "<a href='../logout.php'>Đăng Xuất</a>";
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
            <div class="table-view">
                <h2>Quản Lý Tài Khoản</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Họ và Họ Đệm</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Mật Khẩu</th>
                        <th>Quyền</th>
                        <th>Tính Năng</th>
                    </tr>
                    <?php
                    require '../connect.php';
                    mysqli_set_charset($conn, 'UTF8');

                    $sql = "SELECT a.account_id,a.last_name,a.first_name,a.email,a.password,r.role_name
                     FROM account a
                    INNER JOIN role r On  a.role_id = r.role_id;";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            $bgColor = ($i % 2 == 0) ? 'lightgreen' : 'white';
                            $account_id = $row["account_id"];
                            echo "<tr style='background-color: $bgColor;'>";
                            echo "<td>" . $row["account_id"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["first_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["role_name"] . "</td>";
                            // icon của phần tính năng
                            // tính năng xóa 
                            echo "<td>" . " <a href='delete.php?account_id=" . $account_id . "' title ='Xóa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                </svg>
                                            </a>";
                            // tính năng Sửa 
                            echo  " <a href='change_info_account.php?account_id=" . $account_id . "' title ='Sửa'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
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
            </div>
        </main>
    <?php
    } else {
    ?>
        <div class="card--nou">
            <div class="nou-no-admin">
                <h2 id=>Không có quyền truy cập</h2>
                <p style="color:rgb(175, 136, 21)">Vui lòng chuyển trang vì bạn không có quyền để sử dụng chức năng này!</p></br>
                <button class="back-to-login-button"><a href="../index.php">Quay lại trang chủ</a></button>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>