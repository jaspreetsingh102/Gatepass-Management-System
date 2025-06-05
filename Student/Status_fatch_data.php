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

// Prepare and execute the query for the specific user
$stmt = $conn->prepare("SELECT Enrollment_No, Reason, Leaving_Date, status FROM leave_requests WHERE Enrollment_No = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="status-container">';
    while ($row = $result->fetch_assoc()) {
        // Determine the color based on the status
        $color = '';
        switch ($row['status']) {
            case 'Approved':
                $color = 'green';
                break;
            case 'Rejected':
                $color = 'red';
                break;
            case 'Pending':
                $color = 'orange';
                break;
            default:
                $color = 'gray';
                break;
        }

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