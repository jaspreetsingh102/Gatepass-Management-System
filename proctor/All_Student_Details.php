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

$sql = "SELECT * FROM s_db";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Student Details</title>
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
    <h2><i class="fas fa-users me-2"></i>All Student Details</h2>
    <button class="btn btn-danger btn-sm" onclick="window.location.href='dashboard.php'">Back To Dashboard</button>
  </div>

  <div class="container table-container glass">
    <h4 class="text-info">All Registered Students</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Enrollment_No</th>
            <th>SurName</th>
            <th>Student_Name</th>
            <th>Father_Name</th>
            <th>S_contact_No</th>
            <th>Institute</th>            
            <th>Batch</th>
            <th>Hostel_Block_No</th>
            <th>Hostel_Room_No</th>            
            <th>Address_Line1</th>
            <th>Address_Line2</th>
            <th>s_DOB</th>            
            <th>P_Full_Name</th>
            <th>P_contact_No_1</th>
            <th>P_contact_No_2</th>
            <th>P_email_id</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Enrollment_No']}</td>
                        <td>{$row['SurName']}</td>
                        <td>{$row['Student_Name']}</td>
                        <td>{$row['Father_Name']}</td>
                        <td>{$row['S_contact_No']}</td>
                        <td>{$row['Institute']}</td>
                        <td>{$row['Batch']}</td>
                        <td>{$row['Hostel_Block_No']}</td>
                        <td>{$row['Hostel_Room_No']}</td>
                        <td>{$row['Address_Line1']}</td>
                        <td>{$row['Address_Line2']}</td>
                        <td>{$row['s_DOB']}</td>
                        <td>{$row['P_Full_Name']}</td>
                        <td>{$row['P_contact_No_1']}</td>
                        <td>{$row['P_contact_No_2']}</td>
                        <td>{$row['P_email_id']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
