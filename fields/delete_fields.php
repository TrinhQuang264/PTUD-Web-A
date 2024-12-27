<?php
require '../connect.php';
$field_id = $_GET["field_id"];
mysqli_set_charset($conn, 'UTF8');


$sql_check = "SELECT * FROM courses WHERE field_id = '$field_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "<script>alert('Không thể xóa vì cái này đang được sử dụng ở đâu đấy');</script>";
    echo "<script>window.location.href = 'table_fields.php';</script>";
} else {
    $sql = "DELETE FROM fields WHERE field_id ='$field_id' ";
    if ($conn->query($sql) === TRUE) {
        echo "da xoa thanh cong";
        header("location: table_fields.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
