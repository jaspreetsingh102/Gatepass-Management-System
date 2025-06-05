<?php

include 'db_connection.php';  // Include the database connection

// Initialize variables
$roomFilter = '';
$sql = "SELECT * FROM s_db";

// Check if a room filter is applied
if (isset($_GET['room']) && $_GET['room'] != 'RoomDetail') {
    $roomFilter = $_GET['room'];
    $sql .= " WHERE Hostel_Room_No = '$roomFilter'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" type="text/css" href="rac.css">
    <style>
        /* Professional Background */
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
            text-align: center;
            width: 85%;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .header .block {
            font-size: 24px;
            font-weight: bold;
        }

        .user {
            display: flex;
            align-items: center;
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
            margin-left: 10px;
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
        }

        .nav select, .nav button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            background: #4CAF50;
            color: white;
            font-weight: bold;
        }

        /* Table container with scroll */
        .excel-container {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px;
            border-radius: 10px;
            width: 90%;
            text-align: center;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 400px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        /* Custom Scrollbars */
        .excel-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .excel-container::-webkit-scrollbar-thumb {
            background: #4CAF50;
            border-radius: 5px;
        }

        .excel-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="block">H Block</div>
            <div class="user">
                <select id="userDropdown">
                    <option value="">Rector</option>
                    <option value="">More info</option>
                </select>
                <button><a href="http://localhost/Modern-Login-master/">Sign In</a></button>
                <button><a href="http://localhost/project/Ractor/login/">Logout</a></button>
            </div>
        </div>

        <div class="nav">
        <select id="roomDetailDropdown" onchange="redirectToRoom(this.value)">
    <option value="RoomDetail" <?php if ($roomFilter == 'RoomDetail') echo 'selected'; ?>>RoomDetail</option>
    <option value="101" <?php if ($roomFilter == '101') echo 'selected'; ?>>101</option>
    <option value="102" <?php if ($roomFilter == '102') echo 'selected'; ?>>102</option>
    <option value="103" <?php if ($roomFilter == '103') echo 'selected'; ?>>103</option>
</select>

<script>
function redirectToRoom(room) {
    if (room === "RoomDetail") {
        window.location.href = "http://localhost/project/rac/rac/rac.php"; // Redirect to the All Students page
    } else {
        window.location.href = "?room=" + room; // Redirect to the selected room filter
    }
}
</script>

            
            <script>
    function filterRoom(room) {
        window.location.href = "?room=" + room;
    }
</script>

            <select id="gatePassDropdown" onchange="filterGatePass(this.value)">

            <option value="View Gate Pass Request">View Gate Pass Request</option>
            <option value="all">All Requests</option>
            <option value="pending">Pending Requests</option>
            <option value="approved">Approved Requests</option>
            <option value="rejected">Rejected Requests</option>
</select>

<script>
    function filterGatePass(status) {
        window.location.href = "viewGatePass.php?status=" + status;
    }
</script>

            <button id="checkOutsideButton" onclick="checkOutside()">Check Student Outside Gate</button>
<button id="roomDetailButton" onclick="viewAllStudents()">All Student Details</button>

<script>
    function checkOutside() {
        // Redirect to the page that checks students outside the gate
        window.location.href = "checkOutside.php";
    }

    function viewAllStudents() {
        // Redirect to the page that displays all student details
        window.location.href = "http://localhost/project/rac/rac/all_student_detail.php";
    }
</script>

        </div>
    </div>

    <h3 style="margin-top: 20px;">Student Data</h3>

    <div class="excel-container">
        <table>
            <tr>
                <th>SurName</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Enrollment No</th>
                <th>Email ID</th>
                <th>Contact No</th>
                <th>Institute</th>
                <th>Batch</th>
                <th>Department</th>
                <th>Hostel Block</th>
                <th>Room No</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Parent Name</th>
                <th>Parent Contact 1</th>
                <th>Parent Contact 2</th>
                <th>Parent Email</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo
                    "<tr>
                        <td>{$row['SurName']}</td>
                        <td>{$row['Student_Name']}</td>
                        <td>{$row['Father_Name']}</td>
                        <td>{$row['Enrollment_No']}</td>
                        <td>{$row['Email_id']}</td>
                        <td>{$row['S_contact_No']}</td>
                        <td>{$row['Institute']}</td>
                        <td>{$row['Batch']}</td>
                        <td>{$row['Department']}</td>
                        <td>{$row['Hostel_Block_No']}</td>
                        <td>{$row['Hostel_Room_No']}</td>
                        <td>{$row['Address_Line1']}, {$row['Address_Line2']}</td>
                        <td>{$row['s_DOB']}</td>
                        <td>{$row['P_Full_Name']}</td>
                        <td>{$row['P_contact_No_1']}</td>
                        <td>{$row['P_contact_No_2']}</td>
                        <td>{$row['P_email_id']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='17' class='text-center'>No Students Found</td></tr>";
            }
            ?>

        </table>
    </div>

    <script src="rac.js"></script>
</body>
</html>

<?php $conn->close(); // Close database connection ?>