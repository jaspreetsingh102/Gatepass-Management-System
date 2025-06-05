<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Admin Dashboard</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#manage">Manage Users</a>
        </li>
    </ul>

    <div class="tab-content mt-4">
        <!-- Dashboard -->
        <div class="tab-pane container active" id="dashboard">
            <h3>Dashboard</h3>
            <p>Welcome to the admin panel.</p>
        </div>

        <!-- Manage Users -->
        <div class="tab-pane container fade" id="manage">
            <?php include('manage_user.php'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
