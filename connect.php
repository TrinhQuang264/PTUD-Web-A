<?php
$servername = "localhost";
$username = "root";
$password = ""; // ko co pass
$db = "testmoi";

// create connect
$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
