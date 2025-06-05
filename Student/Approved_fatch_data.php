<?php
session_start(); // Start the session to access session variables

// Database configuration
$host = 'localhost';
$dbname = 'gatepass';
$username = 'root';
$password = '';

// Establish connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's username from session
if (!isset($_SESSION['username'])) {
    echo '<p>User not logged in.</p>';
    exit;
}
$username = $_SESSION['username'];

// Fetch data from the database where status is 'Approved' and username matches the logged-in user
$stmt = $conn->prepare("SELECT Enrollment_No, Reason, Leaving_Date, status FROM leave_requests WHERE Enrollment_No = ? AND status = 'Approved'");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="status-container">';
    while ($row = $result->fetch_assoc()) {
        // Set the color for approved status
        $color = 'green';

        // Generate the box
        echo '<div class="status-box" style="background-color: ' . $color . ';">';
        echo '<p>Reason: <strong>' . htmlspecialchars($row['Reason']) . '</strong></p>';
        echo '<p>Leaving_Date: <strong>' . htmlspecialchars($row['Leaving_Date']) . '</strong></p>';
        echo '<p>Status: <strong>' . htmlspecialchars($row['status']) . '</strong></p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>No data found.</p>';
}

// Close connection
$stmt->close();
$conn->close();
?>