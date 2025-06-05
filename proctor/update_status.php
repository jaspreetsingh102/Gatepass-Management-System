<?php
header("Content-Type: application/json");

// DB Config
$host = 'localhost';
$dbname = 'gatepass';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Connection failed"]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);
$enrollment_no = trim($data['Enrollment_No'] ?? '');
$status = trim($data['Status'] ?? '');
$now = date("Y-m-d H:i:s");

if (!$enrollment_no || !$status) {
    echo json_encode(["success" => false, "error" => "Missing enrollment number or status"]);
    exit;
}

// Common validation done — now apply status-based logic
switch ($status) {
    case 'Approved':
        $sql = "UPDATE leave_requests SET Status = ? WHERE Leaving_Time = ?, Returning_Time = ? AND Enrollment_No = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $status, $now, $now, $enrollment_no);
        $executed = $stmt->execute();
        $stmt->close();
        $msg = "Status set to Approved";
        break;

    case 'Rejected':
        $sql = "UPDATE leave_requests SET Status = ? WHERE Leaving_Time = ?, Returning_Time = ? AND Enrollment_No = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $status, $enrollment_no);
        $executed = $stmt->execute();
        $stmt->close();
        $msg = "Status set to Rejected";
        break;

    case 'Pending':
        $sql = "UPDATE leave_requests SET Status = ? WHERE Leaving_Time = ?, Returning_Time = ? AND Enrollment_No = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $status, $enrollment_no);
        $executed = $stmt->execute();
        $stmt->close();
        $msg = "Status set to Pending";
        break;

    default:
        echo json_encode(["success" => false, "error" => "Invalid status"]);
        exit;
}

if ($executed) {
    echo json_encode(["success" => true, "message" => $msg]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to update status"]);
}

$conn->close();
?>
