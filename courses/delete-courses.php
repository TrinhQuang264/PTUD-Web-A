<?php
require '../connect.php';
$course_id = $_GET["course_id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM courses WHERE course_id ='$course_id'";

if ($conn->query($sql) === TRUE) {
    echo "Đã xóa thành công khóa học và các chi tiết liên quan.";
    header("location: table-courses.php");
    exit();
} else {
    echo "Error deleting course: " . $conn->error;
}

$conn->close();
