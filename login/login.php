<?php
ob_start();
session_start();
include 'db_connection.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check in r_db (Rector)
    $r_query = "SELECT * FROM r_db WHERE email = '$email' AND dob = '$password'";
    $r_result = mysqli_query($conn, $r_query);
    if ($r_result && mysqli_num_rows($r_result) === 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($r_result);
        $_SESSION['role'] = 'ractor';
        header("Location: http://localhost/project/rac/rac/rac.php");
        exit();
    }

    // Check in p_db (Proctor)
    $p_query = "SELECT * FROM p_db WHERE Pr_Email = '$email' AND password = '$password'";
    $p_result = mysqli_query($conn, $p_query);
    if ($p_result && mysqli_num_rows($p_result) === 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($p_result);
        $_SESSION['role'] = 'proctor';
        header("Location: http://localhost/project/New%20folder/proctor/dashboard.php");
        exit();
    }

    $error = "Invalid email or password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rector/Proctor Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            font-family: 'Segoe UI', sans-serif;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: rgba(255,255,255,0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px #fff;
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            background-color: transparent;
            color: white;
            border: 1px solid #ccc;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .btn-login {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #e0a800;
        }

        .error {
            color: #ff6b6b;
            font-weight: bold;
        }

        h2 {
            font-weight: bold;
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 class="text-center">Login</h2>
        <?php if ($error) echo "<p class='error text-center'>$error</p>"; ?>
        <form method="post" autocomplete="off">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter email">
            </div>
            <div class="form-group">
                <label>Password (DOB or custom)</label>
                <input type="text" name="password" class="form-control" required placeholder="YYYY-MM-DD or password">
            </div>
            <button type="submit" class="btn btn-login btn-block">Login</button>
        </form>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
