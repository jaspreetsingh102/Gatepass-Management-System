<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            background: #141e30;
            color: white;
            font-family: Arial;
            text-align: center;
            padding-top: 100px;
        }
        .box {
            background-color: rgba(255,255,255,0.1);
            padding: 30px;
            margin: auto;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0 0 10px #fff;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Welcome, <?php echo $user['full_name'] ?? $user['Pr_Name']; ?></h2>
        <p>You are logged in as: <strong><?php echo ucfirst($role); ?></strong></p>
        <a href="logout.php" style="color: #ffc107;">Logout</a>
    </div>
</body>
</html>
