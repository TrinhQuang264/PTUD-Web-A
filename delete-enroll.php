<?php
require 'connect.php';
$enroll_id = $_GET["enroll_id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM enrolls WHERE enroll_id ='$enroll_id' ";

if ($conn->query($sql) === TRUE) {
    echo "da xoa thanh cong";
    header("location: table-enrolls.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
