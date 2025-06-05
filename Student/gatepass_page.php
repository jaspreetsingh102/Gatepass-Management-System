<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="gatepass_styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="container">s
        <div class="sidebar">
            <div class="profile-picture"></div>
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
        <div class="main-content">
            <div class="student-card">
                <div class="profile-pic-large"></div>
                <?php
                // Include fetch_gatepass_data.php to get the student's name
                include "fetch_gatepass_data.php";
                ?>
                <button id="download-pdf" class="download-button">Download Gate Pass as PDF</button>
            </div>
        </div>
    </div>
    <script src="gatepass_script.js"></script>
</body>
</html>