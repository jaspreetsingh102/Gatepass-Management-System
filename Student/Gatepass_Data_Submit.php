<?php
session_start(); // Start the session at the very beginning

// Database configuration
$host = 'localhost';
$dbname = 'gatepass';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from the form
$Enrollment_No = $_POST['enrollment_no'];
$Reason = $_POST['reason'];
$Location = $_POST['location'];
$Leave_date = $_POST['leaving_date'];
$Return_date = $_POST['returning_date'];
$leave_time = $_POST['leaving_time'];
$return_time = $_POST['returning_time'];
$status = 'Pending'; // Default status

$Leaving_Date = date('Y-m-d', strtotime($Leave_date));
$Returning_Date = date('Y-m-d', strtotime($Return_date));
$Leaving_Time = date('H:i:s', strtotime($leave_time));
$Returning_Time = date('H:i:s', strtotime($return_time));

// Prepare and bind (update column names if needed)
$stmt = $conn->prepare("INSERT INTO leave_requests (Enrollment_No, Reason, Location, Leaving_Date, Leaving_Time, Returning_Date, Returning_Time, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $Enrollment_No, $Reason, $Location, $Leaving_Date, $Leaving_Time, $Returning_Date, $Returning_Time, $status);

// Execute the statement
if ($stmt->execute()) {
    // Set session variables
    $_SESSION['message'] = "Your request has been submitted successfully";
    $_SESSION['msg_type'] = "success";
    // Run the email.php file
    include 'email.php'; // Include the email script
} else {
    // Set session variables for error
    $_SESSION['message'] = "Error: " . $stmt->error;
    $_SESSION['msg_type'] = "danger";
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect to a confirmation page or back to the form
header("Location: Student_Dashboard.php");
exit();
?>