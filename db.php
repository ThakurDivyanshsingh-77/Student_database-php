<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student_management";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
