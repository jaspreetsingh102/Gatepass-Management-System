<?php

date_default_timezone_set("Asia/Kolkata");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gatepass";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get current date and time in SQL-compatible format with milliseconds
$microtime = microtime(true);
$datetimeWithMs = date("Y-m-d H:i:s", $microtime) . '.' . sprintf("%03d", ($microtime - floor($microtime)) * 1000);

$current_time = date("H:i:s");
$current_date = date("Y-m-d");

// Define $result outside the block
$result = null;

$sql = "
    SELECT 
        leave_requests.Enrollment_No,
        leave_requests.Reason,
        leave_requests.Location,
        leave_requests.Leaving_Date,
        leave_requests.Leaving_Time,
        leave_requests.Returning_Date,
        leave_requests.Returning_Time
    FROM leave_requests
    WHERE leave_requests.Leaving_Date = '$current_date' 
    AND leave_requests.Leaving_Time >= '$current_time'
    AND leave_requests.status = 'Approved'
";

$result = $conn->query($sql);

if (isset($_GET['fetch'])) {
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode([
        "data" => $data,
        "server_time" => $datetimeWithMs // now includes milliseconds
    ]);

    $conn->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Check Student Outside Gate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      background: url('Wave world_.gif') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .header {
      padding: 20px;
      background: rgba(15, 32, 39, 0.8);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #17a2b8;
      box-shadow: 0 20px 30px rgba(0, 0, 0, 0.5);
    }

    .header h2 {
      font-weight: bold;
      text-shadow: 2px 2px #000;
      margin: 0;
    }

    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(5px);
      border-radius: 10px;
    }

    .table-container {
      background: rgba(31, 42, 56, 0.8);
      padding: 20px;
      margin: 40px auto;
      max-width: 90%;
      border-radius: 15px;
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
    }

    th, td {
      color: #e0e0e0;
    }

    th {
      background: #2c3e50;
    }

    .back-btn {
      margin: 20px;
    }
  </style>
</head>
<body>
  <div class="header glass">
    <h2><i class="fas fa-door-open me-2"></i>Check Student Outside Gate</h2>
    <button class="btn btn-danger btn-sm" onclick="window.location.href='dashboard.php'">Back To Dashboard</button>
  </div>

  <div class="container table-container glass">
    <h4 class="text-info">Students Currently Outside</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Enrollment_No</th>
            <th>Reason No</th>
            <th>Location</th>
            <th>Leaving_Date</th>
            <th>Leaving_Time</th>
            <th>Returning_Date</th>
            <th>Returning_Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                      <td>".$row["Enrollment_No"]."</td>
                      <td>".$row["Reason"]."</td>
                      <td>".$row["Location"]."</td>
                      <td>".$row["Leaving_Date"]."</td>
                      <td>".$row["Leaving_Time"]."</td>
                      <td>".$row["Returning_Date"]."</td>
                      <td>".$row["Returning_Time"]."</td>
                  </tr>";
              }
          } else {
              echo "<tr><td colspan='7'>No student OutSide The Gate.</td></tr>";
          }
          $conn->close();
          ?>
      </table>
    </tbody>
    </div>
  </div>
</body>
</html>