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

$sql = "SELECT * FROM leave_requests WHERE DATEDIFF(Returning_Date, Leaving_Date) >= 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Management </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: url('Wave world_.gif') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
      box-shadow: 0 20px 30px rgba(0, 0, 0, 0.5);
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

    .table-container {
      background: rgba(31, 42, 56, 0.8);
      padding: 20px;
      margin: 40px auto;
      border-radius: 15px;
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
    }

    table {
      margin-top: 20px;
      width: 100%;
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

    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(5px);
      border-radius: 10px;
    }

    .status-cell {
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      font-weight: bold;
    }

    .status-cell.approved {
      color: lightgreen;
    }

    .status-cell.rejected {
      color: #ff4d4d;
    }

    @keyframes statusChange {
      0% { transform: scale(1); background-color: transparent; }
      50% { transform: scale(1.2); background-color: #17a2b8; color: white; }
      100% { transform: scale(1); background-color: transparent; }
    }

    .status-cell.animate {
      animation: statusChange 0.5s ease;
    }
  </style>
</head>
<body>
  <div class="left-content">
    <div class="header container-fluid glass">
      <div class="title-bar d-flex align-items-center">
        <i class="fas fa-building fa-2x me-2"></i>
        <h2>Student Management </h2>
      </div>
      <div class="d-flex flex-wrap align-items-center">
        <button class="btn btn-success btn-sm" onclick="window.location.href='Approved_Requests.php'">Approve Gate Pass</button>
        <button class="btn btn-danger btn-sm" onclick="window.location.href='Rejected_Requests.php'">Reject Gate Pass</button>
        <select class="form-select form-select-sm me-2 w-auto" id="roleSelect">
          <option value="proctor">Proctor</option>
        </select>
        <button class="btn btn-danger btn-sm" onclick="window.location.href='http://localhost/project/New%20folder/login/login.php'">Logout</button>
      </div>
    </div>

    <div class="container table-container glass">
      <h4 class="text-info">Gate Pass Requests</h4>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Enrollment No</th>
              <th>Reason</th>
              <th>Location</th>
              <th>Leaving Date</th>
              <th>Leaving Time</th>
              <th>Returning Date</th>
              <th>Returning Time</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $statusClass = strtolower($row["Status"]);
                echo "<tr>
                  <td>{$row["Enrollment_No"]}</td>
                  <td>{$row["Reason"]}</td>
                  <td>{$row["Location"]}</td>
                  <td>{$row["Leaving_Date"]}</td>
                  <td>{$row["Leaving_Time"]}</td>
                  <td>{$row["Returning_Date"]}</td>
                  <td>{$row["Returning_Time"]}</td>
                  <td class='status-cell $statusClass'>{$row["Status"]}</td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='8'>No gate pass requests found.</td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
document.querySelectorAll(".status-cell").forEach(cell => {
  cell.addEventListener("click", () => {
    const row = cell.parentElement;
    const enrollmentNo = row.querySelector("td:first-child").textContent.trim();
    let newStatus;

    if (cell.textContent === "Pending") {
      newStatus = "Approved";
      cell.textContent = "Approved";
      cell.classList.remove("rejected");
      cell.classList.add("approved", "animate");
    } else if (cell.textContent === "Approved") {
      newStatus = "Rejected";
      cell.textContent = "Rejected";
      cell.classList.remove("approved");
      cell.classList.add("rejected", "animate");
    } else if (cell.textContent === "Rejected") {
      newStatus = "Approved";
      cell.textContent = "Approved";
      cell.classList.remove("rejected");
      cell.classList.add("approved", "animate");
    }

    // Remove the animation class so it can re-trigger on next click
    setTimeout(() => {
      cell.classList.remove("animate");
    }, 500);

    // Send AJAX request to update the database
    fetch("update_status.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        enrollment_no: enrollmentNo,
        status: newStatus
      })
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log("Status updated successfully");
        } else {
          console.error("Failed to update status:", data.error);
        }
      })
      .catch(error => console.error("Error:", error));
  });
});
  </script>
</body>
</html>