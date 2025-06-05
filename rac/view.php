<?php
include 'db_connection.php';

if (!isset($_GET['id'])) {
    echo "No leave request ID provided.";
    exit;
}

$id = $_GET['id'];

// Get leave request data
$leave_sql = "SELECT * FROM leave_requests WHERE id = '$id'";
$leave_result = mysqli_query($conn, $leave_sql);
$leave_data = mysqli_fetch_assoc($leave_result);

if (!$leave_data) {
    echo "Leave request not found.";
    exit;
}

// Get student data using Enrollment_No
$enroll = $leave_data['Enrollment_No'];
$student_sql = "SELECT * FROM student_detail WHERE Enrollment_No = '$enroll'";
$student_result = mysqli_query($conn, $student_sql);
$student_data = mysqli_fetch_assoc($student_result);

if (!$student_data) {
    echo "Student details not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Leave Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .label-title { font-weight: bold; color: #333; }
        .card { margin-top: 20px; }
    </style>
</head>
<body class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Student Leave Details</h4>
        <a href="studentleaverequests.php" class="btn btn-secondary">← Back</a>
    </div>

    <!-- Student Info -->
    <div class="card">
        <div class="card-header">Student Information</div>
        <div class="card-body row">
            <div class="col-md-6"><span class="label-title">Name:</span> <?php echo $student_data['SurName'] . ' ' . $student_data['Student_Name']; ?></div>
            <div class="col-md-6"><span class="label-title">Enrollment No:</span> <?php echo $student_data['Enrollment_No']; ?></div>
            <div class="col-md-6"><span class="label-title">Father Name:</span> <?php echo $student_data['Father_Name']; ?></div>
            <div class="col-md-6"><span class="label-title">Email:</span> <?php echo $student_data['Email_id']; ?></div>
            <div class="col-md-6"><span class="label-title">Contact:</span> <?php echo $student_data['S_contact_No']; ?></div>
            <div class="col-md-6"><span class="label-title">DOB:</span> <?php echo $student_data['s_DOB']; ?></div>
            <div class="col-md-6"><span class="label-title">Institute:</span> <?php echo $student_data['Institute']; ?></div>
            <div class="col-md-6"><span class="label-title">Department:</span> <?php echo $student_data['Department']; ?></div>
        </div>
    </div>

    <!-- Leave Info -->
    <div class="card">
        <div class="card-header">Leave Request</div>
        <div class="card-body row">
            <div class="col-md-6"><span class="label-title">Reason:</span> <?php echo $leave_data['Reason']; ?></div>
            <div class="col-md-6"><span class="label-title">Location:</span> <?php echo $leave_data['Location']; ?></div>
            <div class="col-md-6"><span class="label-title">Leaving Date:</span> <?php echo $leave_data['Leaving_Date']; ?></div>
            <div class="col-md-6"><span class="label-title">Returning Date:</span> <?php echo $leave_data['Returning_Date']; ?></div>
            <div class="col-md-6"><span class="label-title">Leaving Time:</span> <?php echo $leave_data['Leaving_Time']; ?></div>
            <div class="col-md-6"><span class="label-title">Returning Time:</span> <?php echo $leave_data['Returning_Time']; ?></div>
            <div class="col-md-6"><span class="label-title">Status:</span> <?php echo $leave_data['Status']; ?></div>
        </div>
    </div>

</body>
</html>
