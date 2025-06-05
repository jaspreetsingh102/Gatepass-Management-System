<?php
include 'db_connect.php';

$enrollment_no = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE leave_requests SET Status='$status' WHERE Enrollment_No=$enrollment_no";
mysqli_query($conn, $query);

header("Location: fetch_students.php");
?>