<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gatepass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM leave_requests WHERE status = 'Approved'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Approved Requests</title>
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
      max-width: 95%;
      border-radius: 15px;
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
    }

    th, td {
      color: #e0e0e0;
    }

    th {
      background: #2c3e50;
    }

    .btn-back {
      margin-left: auto;
    }
  </style>
</head>
<body>
  <div class="header glass">
    <h2><i class="fas fa-users me-2"></i>Approved Requests Details</h2>
    <a href="index.html" class="btn btn-danger btn-sm btn-back">Back to Dashboard</a>
  </div>

  <div class="container table-container glass">
    <h4 class="text-info">Approved Requests Details</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Enrollment_No</th>
            <th>Reason</th>
            <th>Location</th>
            <th>Leaving_Date</th>
            <th>Leaving_Time</th>
            <th>Returning_Date</th>
            <th>Returning_Time</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
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
            echo "<tr><td colspan='4'>No approved requests found.</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
