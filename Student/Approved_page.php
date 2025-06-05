<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="Approved_styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="avatar">👤</div>
            <h2>Student Name</h2>
            <ul>
                <li><button onclick="location.href='Leave_Request_page.html'">📩 Leave Request</button></li>
                <li><button onclick="location.href='gatepass_page.php'">🚪 Gate Pass</button></li>
                <li><button onclick="location.href='Status_Page.php'">📊 Status</button></li>
                <li><button onclick="location.href='Approved_page.php'">✅ Approved</button></li>
                <li><button onclick="location.href='Rejected_page.php'">❌ Rejected</button></li>
                <li><button>👣 Visits</button></li>
            </ul>
            <button class="logout" onclick="location.href='Student_login_page.html'">🚪 Logout</button>
        </div>
        <div class="content">
            <?php
            include "Approved_fatch_data.php"; // Include the PHP file to fetch data
            ?>
        </div>
    </div>
    <script src="Approved_script.js"></script>
</body>
</html>