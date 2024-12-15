<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Hủy session để thực hiện đăng xuất -->
    <?php
    session_start();
    // xóa session
    session_unset();
    header("location: index.php");
    ?>

</body>

</html>