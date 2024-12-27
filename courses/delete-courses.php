<?php
require '../connect.php';
$course_id = $_GET["course_id"];
mysqli_set_charset($conn, 'UTF8');


$sql1 = "DELETE FROM enrolls WHERE course_id = '$course_id'";

if ($conn->query($sql1) === TRUE) {

    $sql2 = "DELETE FROM detail_courses WHERE course_id = '$course_id'";

    if ($conn->query($sql2) === TRUE) {

        $sql3 = "DELETE FROM courses WHERE course_id = '$course_id'";

        if ($conn->query($sql3) === TRUE) {

            header("location: table-courses.php");
            exit();
        } else {
            echo "Error deleting course: " . $conn->error;
        }
    } else {
        echo "Error deleting details: " . $conn->error;
    }
} else {
    echo "Error deleting enrollments: " . $conn->error;
}

$conn->close();
