<?php
require '../connect.php';
$course_id = $_GET["course_id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM courses WHERE course_id ='$course_id' ";

if ($conn->query($sql) === TRUE) {
    echo "da xoa thanh cong";
    header("location: table-courses.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
