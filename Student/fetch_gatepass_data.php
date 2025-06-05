<?php
session_start(); // Start the session

// Database configuration
$host = 'localhost';
$dbname = 'gatepass';
$db_username = 'root';
$db_password = '';

// Establish connection
$conn = new mysqli($host, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session variable is set
if (isset($_SESSION['username'])) {
    $enrollment_no = $_SESSION['username']; // Use the session variable

    // Fetching data from the database
    $sql = "SELECT * FROM s_db WHERE Enrollment_No = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enrollment_no); // "s" for string type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Fetch data and store in variables
        $row = $result->fetch_assoc();
        echo "<h3>Enrollment No: <span>" . htmlspecialchars($row["Enrollment_No"]) . "</span></h3>";
        echo "<h3>Student Name: <span>" . htmlspecialchars($row["Student_Name"]) . "</span></h3>";
        echo "<h3>Batch: <span>" . htmlspecialchars($row["Batch"]) . "</span></h3>";
    } else {
        echo "<h3>No results found in s_db</h3>";
    }

    // Fetching data from the database
    $sql = "SELECT * FROM leave_requests WHERE Enrollment_No = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enrollment_no); // "s" for string type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Fetch data and store in variables
        $row = $result->fetch_assoc();
        echo "<h3>Leaving Date: <span>" . date("d-m-Y", strtotime($row['Leaving_Date'])) . "</span></h3>";
        echo "<h3>Leaving Time: <span>" . htmlspecialchars($row["Leaving_Time"]) . "</span></h3>";
        echo "<h3>Returning Date: <span>" .date("d-m-Y", strtotime($row["Returning_Date"])) . "</span></h3>";
        echo "<h3>Returning Time: <span>" . htmlspecialchars($row["Returning_Time"]) . "</span></h3>";
    } else {
        echo "<h3>No leave requests found</h3>";
    }
} else {
    echo "<h3>username number not set in session</h3>";
}

// Close connection
$conn->close();
?>