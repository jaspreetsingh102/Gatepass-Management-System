<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM leave_requests WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $update = "UPDATE leave_requests SET Status = '$status' WHERE id = $id";
    mysqli_query($conn, $update);
    header("Location: studentleaverequests.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Leave Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>Edit Leave Request</h3>
    <form method="post">
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending" <?php if ($row['Status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Approved" <?php if ($row['Status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($row['Status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="studentleaverequests.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
