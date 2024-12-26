<?php
require '../connect.php';
$id = $_GET["id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM enrolls WHERE id ='$id' ";

if ($conn->query($sql) === TRUE) {
    echo "da xoa thanh cong";
    header("location: table-enrolls.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
