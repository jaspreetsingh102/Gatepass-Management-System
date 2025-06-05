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

// Get selected room from URL, if any
$roomFilter = isset($_GET['room']) ? $_GET['room'] : '';

// Query: Filter by room if selected
$sql = "SELECT * FROM s_db";
if ($roomFilter !== '') {
    $roomFilterEscaped = $conn->real_escape_string($roomFilter);
    $sql .= " WHERE Hostel_Room_No = '$roomFilterEscaped'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: url('Wave world_.gif') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      perspective: 1000px;
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
    }
    .left-content {
      flex: 1;
      min-width: 700px;
    }
    .header {
      padding: 20px;
      background: rgba(15, 32, 39, 0.8);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      border-bottom: 3px solid #17a2b8;
      transform: rotateX(5deg);
      box-shadow: 0 20px 30px rgba(0, 0, 0, 0.5);
      width: 100%;  
    }
    .header h2 {
      font-weight: bold;
      text-shadow: 2px 2px #000;
    }
    .header .d-flex {
      width: 100%;  
      justify-content: center;  
      align-items: center;
      flex-wrap: wrap;
    }

    .header .d-flex button,
    .header .d-flex select {
      margin: 5px 10px;  
    }

    .header .d-flex button {
      transition: background-color 0.3s, transform 0.3s;
    }

    .header .d-flex button:hover {
      background-color: #17a2b8;  
      transform: scale(1.05);  
    }

    .header .d-flex select {
      background-color: #2c3e50;  
      color: #fff;  
      border: 1px solid #34495e;  
    }

    .header .d-flex select:hover {
      background-color: #17a2b8;  
      border-color: #17a2b8;  
    }

    .btn-green {
      background-color: #28a745;
      color: white;
      border: none;
      transition: 0.3s;
    }
    .btn-green:hover {
      background-color: #218838;
      transform: scale(1.05);
    }
    .btn-danger:hover {
      transform: scale(1.05);
    }
    .table-container {
      background: rgba(31, 42, 56, 0.8);
      padding: 20px;
      margin: 40px auto;
      max-width: 95%;
      border-radius: 15px;
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
      transform: rotateX(8deg);
    }
    table {
      margin-top: 20px;
      transform: rotateX(3deg);
      width: 100%;
      table-layout: auto;
    }
    th, td {
      color: #e0e0e0;
      padding: 12px;
      text-align: center;
      word-wrap: break-word;
      border-bottom: 1px solid #34495e;
    }
    th {
      background: #2c3e50;
      font-size: 1.1em;
      text-transform: uppercase;
    }
    tr:nth-child(even) {
      background-color: #34495e;
    }
    tr:hover {
      background-color: #17a2b8;
      color: white;
    }
    td {
      font-size: 0.9em;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .title-bar i {
      color: #17a2b8;
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(5px);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="left-content">
    <div class="header container-fluid glass">
      <div class="title-bar d-flex align-items-center">
        <i class="fas fa-building fa-2x me-2"></i>
        <h2> Student Management </h2>
      </div>
      <div class="d-flex flex-wrap align-items-center">
        <select class="form-select form-select-sm me-2 w-auto" id="roomSelect" onchange="location = this.value;">
          <option value="dashboard.php">All Rooms</option>
          <?php
          // Fetch distinct room numbers from the database
          $roomQuery = "SELECT DISTINCT Hostel_Room_No FROM s_db ORDER BY Hostel_Room_No";
          $roomResult = $conn->query($roomQuery);

          if ($roomResult->num_rows > 0) {
              while ($roomRow = $roomResult->fetch_assoc()) {
                  $roomNo = $roomRow['Hostel_Room_No'];
                  $selected = ($roomFilter == $roomNo) ? 'selected' : '';
                  echo "<option value=\"dashboard.php?room=$roomNo\" $selected>$roomNo</option>";
              }
          }
          ?>
        </select>
        <button class="btn btn-green btn-sm" onclick="window.location.href='view gatepass system.php'">
            View Gate Pass Request
        </button>
        <button class="btn btn-green btn-sm" onclick="window.location.href='cheak_student_OutsideGate.php'">
            Check Student Outside Gate
        </button>
        <button class="btn btn-green btn-sm" onclick="window.location.href='All_Student_Details.php'">
            All Student Details
        </button>
        <select class="form-select form-select-sm me-2 w-auto" id="roleSelect">
          <option value="proctor">Proctor</option>
        </select>
        <button class="btn btn-danger btn-sm" onclick="window.location.href='http://localhost/project/New%20folder/login/login.php'">Logout</button>
      </div>
    </div>

    <div class="container table-container glass">
      <h4 class="text-info">Student Data</h4>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
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
          </thead>
          <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
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
              echo "<tr><td colspan='16'>No data found.</td></tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>