<?php
include 'db_connection.php';

$query = "
SELECT lr.*, s.Student_Name, s.Hostel_Block_No, s.Hostel_Room_No 
FROM leave_requests lr
JOIN s_db s ON lr.Enrollment_No = s.Enrollment_No
WHERE lr.Status = 'Pending'
ORDER BY lr.Leaving_Date DESC";

$result = mysqli_query($conn, $query);
//include 'status_template.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Status Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
        }
        table {
            color: white;
        }
        th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dropdown-menu a {
            color: #000;
        }
        .dropdown-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .btn-glow {
    background: linear-gradient(145deg, #ffffff, #e6e6e6);
    color: #1e1e2f;
    font-weight: bold;
    border: none;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease-in-out;
    border-radius: 30px;
    padding: 10px 20px;
}

.btn-glow:hover {
    background: #ffc107;
    color: #000;
    box-shadow: 0 0 25px #ffc107, 0 0 10px #ffc107;
    transform: scale(1.05);
}

    </style>
</head>
<body>


<div class="container">
    <h3 class="text-center mb-3">Student Leave Requests - <?php echo $row['Status'] ?? 'Status'; ?></h3>
    <div class="table-responsive"> <!-- Add this wrapper -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Enrollment No</th>
                    <th>Student Name</th>
                    <th>Block</th>
                    <th>Room</th>
                    <th>Reason</th>
                    <th>Location</th>
                    <th>Leaving Date</th>
                    <th>Returning Date</th>
                    <th>Time Out</th>
                    <th>Time In</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['Enrollment_No']; ?></td>
                        <td><?php echo $row['Student_Name']; ?></td>
                        <td><?php echo $row['Hostel_Block_No']; ?></td>
                        <td><?php echo $row['Hostel_Room_No']; ?></td>
                        <td><?php echo $row['Reason']; ?></td>
                        <td><?php echo $row['Location']; ?></td>
                        <td><?php echo $row['Leaving_Date']; ?></td>
                        <td><?php echo $row['Returning_Date']; ?></td>
                        <td><?php echo date("H:i", strtotime($row['Leaving_Time'])); ?></td>
                        <td><?php echo date("H:i", strtotime($row['Returning_Time'])); ?></td>
                        <td><?php echo $row['Status']; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                    Change Status
                                </button>
                                <div class="dropdown-menu">
                                    <form method="POST" action="studentleaverequests.php" class="px-3 py-1">
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
    </div> <!-- Close table-responsive -->
</div>
<br>
<a href="javascript:history.back()" class="btn btn-glow mb-3">
    <i class="fas fa-arrow-left mr-2"></i> Back
</a>






<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
