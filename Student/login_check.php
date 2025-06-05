<?php
session_start(); // Start the session

// Database configuration
$host = 'localhost';
$dbname = 'gatepass';
$username = 'root';
$password = '';

// Establish connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from frontend
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $F_id = $_POST['username'];
    $F_pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM s_db WHERE Enrollment_No = ? AND Password = ?");
    $stmt->bind_param("ss", $F_id, $F_pass);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Set session variables
        $_SESSION['username'] = $F_id;
        header("Location: Student_Dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        echo "<script>
                alert('Invalid username or password.');
                window.location.href = 'Student_login_page.html';
              </script>";
    }

    // Free result and close statement
    $stmt->free_result();
    $stmt->close();
}

// Close connection
$conn->close();
?>