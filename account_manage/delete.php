<?php
require '../connect.php';
$account_id = $_GET["account_id"];
mysqli_set_charset($conn, 'UTF8');

$sql = "DELETE FROM account WHERE account_id ='$account_id' ";

if ($conn->query($sql) === TRUE) {
    echo "da xoa thanh cong";
    header("location: account_manager.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
