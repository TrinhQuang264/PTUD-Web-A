<?php
require '../connect.php';
$field_id = $_GET["field_id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM fields WHERE field_id ='$field_id' ";

if ($conn->query($sql) === TRUE) {
    echo "da xoa thanh cong";
    header("location: table_fields.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
