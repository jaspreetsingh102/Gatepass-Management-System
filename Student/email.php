<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php'; 

// Get user-submitted form data
$enrollment_no = $_POST['enrollment_no'] ?? '';
$reason = $_POST['reason'] ?? '';
$location = $_POST['location'] ?? '';
$leaving_date = $_POST['leaving_date'] ?? '';
$returning_date = $_POST['returning_date'] ?? '';
$leaving_time = $_POST['leaving_time'] ?? '';
$returning_time = $_POST['returning_time'] ?? '';

// Step 1: Connect to MySQL database
$conn = new mysqli("localhost", "root", "", "gatepass");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch parent email from correct table
$sql = "SELECT p_email_id FROM s_db WHERE enrollment_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $enrollment_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $parent_email = $row['p_email_id']; // must match selected column name
} else {
    die("No email found for the given enrollment number.");
}

// Step 3: Send email with PHPMailer
$mail = new PHPMailer(true); 

try { 
    // SMTP configuration
    $mail->isSMTP(); 
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true; 
    $mail->Username   = '23012012001@gnu.ac.in'; 
    $mail->Password   = 'ddwe vled ials jzyt'; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Port       = 587; 

    // Set sender and recipient
    $mail->setFrom('23012012001@gnu.ac.in', 'Gatepass System'); 
    $mail->addAddress($parent_email); 
    $mail->isHTML(true);
    $mail->Subject = 'Leave Request Application'; 

    // Format email body with real-time data
    $mail->Body = "
        <h2>New Leave Request</h2>
        <p><strong>Enrollment No:</strong> $enrollment_no</p>
        <p><strong>Reason:</strong> $reason</p>
        <p><strong>Location:</strong> $location</p>
        <p><strong>Leaving Date:</strong> $leaving_date</p>
        <p><strong>Returning Date:</strong> $returning_date</p>
        <p><strong>Leaving Time:</strong> $leaving_time</p>
        <p><strong>Returning Time:</strong> $returning_time</p>
    "; 

    $mail->send(); 
    echo 'Email sent successfully to parent!'; 
} catch (Exception $e) { 
    echo 'Error sending email: ' . $mail->ErrorInfo; 
}
?>
