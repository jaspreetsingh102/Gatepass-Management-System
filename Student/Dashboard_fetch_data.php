<?php
session_start(); // Always start session at the top

// Assume you've already validated the username (from a form or database)
if (isset($_POST['username'])) {
    $username = $_POST['username']; // Assume this is coming from your form

    // Set session variable
    $_SESSION['username'] = $username;

    // Redirect to the page where you want to show user details
    header('Location: user_details.php'); 
    exit();
} 
?>

<?php
//session_start(); // Always start session at the top

// Check if the session variable is set
if (!isset($_SESSION['username'])) {
    echo "<p>Username not set in session. Please log in first.</p>";
    exit();
}

// Now the session variable 'username' should be set, you can use it
$enrollment_no = $_SESSION['username']; 

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

// SQL query using prepared statements to avoid SQL injection
$sql = "SELECT * FROM s_db WHERE Enrollment_No = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $enrollment_no); // "s" for string type
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<h3>Name : <span>" . htmlspecialchars($row["Student_Name"]) . "</span></h3>";
        echo "<h3>Email : <span>" . htmlspecialchars($row["Email_id"]) . "</span></h3>";
        echo "<h3>Contact No : <span>" . htmlspecialchars($row["S_contact_No"]) . "</span></h3>";
        echo "<h3>Address Line-1 : <span>" . htmlspecialchars($row["Address_Line1"]) . "</span></h3>";
        echo "<h3>Address Line-2 : <span>" . htmlspecialchars($row["Address_Line2"]) . "</span></h3>";
        echo "<h3>Institute : <span>" . htmlspecialchars($row["Institute"]) . "</span></h3>";
        echo "<h3>Department : <span>" . htmlspecialchars($row["Department"]) . "</span></h3>";
        echo "<h3>Batch : <span>" . htmlspecialchars($row["Batch"]) . "</span></h3>";
        echo "<h3>Hostel Block : <span>" . htmlspecialchars($row["Hostel_Block_No"]) . "</span></h3>";
        echo "<h3>Hostel Room : <span>" . htmlspecialchars($row["Hostel_Room_No"]) . "</span></h3>";
    }
} else {
    echo "<p>No results found.</p>";
}

// Close connection
$conn->close();
?>