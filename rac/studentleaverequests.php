<?php
include 'db_connection.php';

// Handle action update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enrollment_no'], $_POST['status'])) {
    $enrollment_no = $_POST['enrollment_no'];
    $status = $_POST['status'];

    // Update in leave_requests table
    $updateLeave = "UPDATE leave_requests SET Status = '$status' WHERE Enrollment_No = '$enrollment_no'";
    mysqli_query($conn, $updateLeave);

    // Update in s_db table
    $updateStudent = "UPDATE s_db SET Status = '$status' WHERE Enrollment_No = '$enrollment_no'";
    mysqli_query($conn, $updateStudent);

    header("Location: studentleaverequests.php?msg=updated");
    exit();
}

// Fetch data
$query = "
SELECT lr.*, s.Student_Name, s.Hostel_Block_No, s.Hostel_Room_No 
FROM leave_requests lr
JOIN s_db s ON lr.Enrollment_No = s.Enrollment_No
ORDER BY lr.Leaving_Date DESC";
$result = mysqli_query($conn, $query);
?>




<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55); /* Modern gradient */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Arial', sans-serif;
            color: white;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .header .block {
            font-size: 24px;
            font-weight: bold;
        }

        .user select, .user button {
            margin-left: 10px;
        }

        .user select {
            padding: 8px;
            border-radius: 5px;
            background: #243b55;
            color: white;
            border: none;
            cursor: pointer;
        }

        .user button {
            background: #4CAF50;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .user button a {
            text-decoration: none;
            color: white;
        }

        .nav {
            margin-top: 10px;
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .nav select, .nav button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            background: #4CAF50;
            color: white;
            font-weight: bold;
            margin: 5px;
        }

        .excel-container {
            margin-top: 20px;
            overflow-x: auto;
            max-height: 450px;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px;
            text-align: center;
        }

        th {
            background: rgba(255, 255, 255, 0.2);
        }

        .dropdown-menu a {
            color: #000;
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }


        .dropdown-item {
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}
.dropdown-item:hover {
    background-color: #141e30;
    transform: translateX(5px);
}


    </style>
</head>
<body>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
    <div class="alert alert-success text-center">Status updated successfully!</div>
<?php endif; ?>


<!-- Top Section Container -->
<div class="container">
    <div class="header">
        <div class="block">H Block</div>
        <div class="user">
            <select id="userDropdown" onchange="navigateUser(this.value)">
                <option value="___.php">Rector</option>
                <option value="rectorInfo.php">More Info</option>
            </select>
            <button><a href="http://localhost/project/Ractor/login/">Logout</a></button>
        </div>
    </div>

<div class="nav">
        <?php
        // Define $roomFilter before using it
        $roomFilter = '';
        if (isset($_GET['room'])) {
            $roomFilter = $_GET['room'];
        } elseif (isset($_GET['RoomDetail'])) {
            $roomFilter = 'RoomDetail';
        }
        ?>
        <select id="roomDetailDropdown" onchange="location = this.value;">
            <option value="?RoomDetail" <?php if ($roomFilter == 'RoomDetail') echo 'selected'; ?>>RoomDetail</option>
            <option value="?room=101" <?php if ($roomFilter == '101') echo 'selected'; ?>>101</option>
            <option value="?room=102" <?php if ($roomFilter == '102') echo 'selected'; ?>>102</option>
            <option value="?room=103" <?php if ($roomFilter == '103') echo 'selected'; ?>>103</option>
        </select>

        <script>
function filterRoom(room) {
    if (room) {
        window.location.href = "http://localhost/project/rac/rac/rac.php?room=" + room;
    }
}
</script>

        <select id="gatePassDropdown" onchange="filterGatePass(this.value)">
            <option value="all">All Requests</option>
            <option value="view">View Gate Pass Request</option>
            <option value="pending">Pending Requests</option>
            <option value="approved">Approved Requests</option>
            <option value="rejected">Rejected Requests</option>
        </select>

        <script>
function filterGatePass(value) {
    switch (value) {
        case "view":
            window.location.href = "rac.php";
            break;
        case "all":
            window.location.href = "studentleaverequests.php";
            break;
        case "pending":
            window.location.href = "pending_requests.php";
            break;
        case "approved":
            window.location.href = "approved_requests.php";
            break;
        case "rejected":
            window.location.href = "rejected_requests.php";
            break;
        default:
            alert("Please select an action.");
    }
}
</script>


<button id="checkOutsideButton" onclick="window.location.href='check_student_outside_gate.php'">Check Student Outside Gate</button>
<button id="RoomDetail" onclick="window.location.href='rac.php'">All Student Details</button>

    </div>
</div>

<!-- Table Section Container -->
<div class="container">
    <?php
    // Set the page title based on the selected filter
    if (isset($_GET['room'])) {
        $pageTitle = "Room " . htmlspecialchars($_GET['room']) . " Leave Requests";
    } elseif (isset($_GET['RoomDetail'])) {
        $pageTitle = "Room Detail Leave Requests";
    } else {
        $pageTitle = "All Leave Requests";
    }
    ?>
<h3 class="text-center mb-3"><?php echo $pageTitle; ?></h3>
    <div class="excel-container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Enrollment No</th>
                    <th>Reason</th>
                    <th>Location</th>
                    <th>Leaving Date</th>
                    <th>Returning Date</th>
                    <th>Leaving Time</th>
                    <th>Returning Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['Enrollment_No']; ?></td>
                        <td><?php echo $row['Reason']; ?></td>
                        <td><?php echo $row['Location']; ?></td>
                        <td><?php echo $row['Leaving_Date']; ?></td>
                        <td><?php echo $row['Returning_Date']; ?></td>
                        <td><?php echo date("H:i", strtotime($row['Leaving_Time'])); ?></td>
                        <td><?php echo date("H:i", strtotime($row['Returning_Time'])); ?></td>
                        <td>
                            <?php
                            date_default_timezone_set("Asia/Kolkata");
                            $now = strtotime(date("Y-m-d H:i:s"));
                            $leaveStart = strtotime($row['Leaving_Date'] . ' ' . $row['Leaving_Time']);
                            $leaveEnd = strtotime($row['Returning_Date'] . ' ' . $row['Returning_Time']);

                            if ($row['Status'] == 'Approved' && $now >= $leaveStart && $now <= $leaveEnd) {
                                echo '<span style="color: orange;">Active</span>';
                            } elseif ($row['Status'] == 'Approved') {
                                echo '<span style="color: lightgreen;">Inactive</span>';
                            } else {
                                echo $row['Status'];
                            }
                            ?>
                        </td>
                        <td>
    <div class="dropdown">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $row['Enrollment_No']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $row['Status']; ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row['Enrollment_No']; ?>">
            <form method="POST" class="px-3 py-1">
                <input type="hidden" name="enrollment_no" value="<?php echo $row['Enrollment_No']; ?>">
                <button class="dropdown-item text-warning" type="submit" name="status" value="Pending"><i class="fas fa-hourglass-half"></i> Pending</button>
                <button class="dropdown-item text-success" type="submit" name="status" value="Approved"><i class="fas fa-check-circle"></i> Approved</button>
                <button class="dropdown-item text-danger" type="submit" name="status" value="Rejected"><i class="fas fa-times-circle"></i> Rejected</button>
            </form>
        </div>
    </div>
</td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Bootstrap & JS Dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function navigateUser(url) {
        if (url) window.location.href = url;
    }

    function filterGatePass(value) {
        switch (value) {
            case "view": window.location.href = "view_gate_pass_request.php"; break;
            case "all": window.location.href = "http://localhost/project/rac/rac/studentleaverequests.php"; break;
            case "pending": window.location.href = "pending_requests.php"; break;
            case "approved": window.location.href = "approved_requests.php"; break;
            case "rejected": window.location.href = "rejected_requests.php"; break;
            default: alert("Please select an action.");
        }
    }
</script>

</body>
</html>

<?php $conn->close(); ?>
