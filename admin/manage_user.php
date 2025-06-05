<?php
$conn = new mysqli("localhost", "root", "", "gatepass");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CSV Upload
if (isset($_POST['upload_csv'])) {
    $table = $_POST['table'];
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === 0) {
        $file = fopen($_FILES['csv_file']['tmp_name'], "r");
        fgetcsv($file); // Skip header

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            $name = $data[0];
            $email = $data[1];
            $dob = $data[2];
            $contact = $data[3];

            $sql = "INSERT INTO `$table` (Student_Name, Email_id, s_DOB, S_contact_No, pass_id, pass) 
                    VALUES ('$name', '$email', '$dob', '$contact', '$email', '$dob')";
            $conn->query($sql);
        }
        fclose($file);
        echo "<div class='alert alert-success'>CSV imported into $table</div>";
    } else {
        echo "<div class='alert alert-danger'>CSV Upload Failed.</div>";
    }
}

// Handle Delete Request
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $delete_id = $_GET['delete'];
    $table = $_GET['table'];

// Decide the column name based on table
if ($table == 's_db') {
    $id_column = 'Enrollment_No';
} elseif ($table == 'r_db') {
    $id_column = 'Rector_Id';
} elseif ($table == 'p_db') {
    $id_column = 'Parent_Id';
} else {
    $id_column = 'Enrollment_No'; // default
}

// Then delete based on correct column
$delete_query = "DELETE FROM `$table` WHERE `$id_column` = '$delete_id'";
    if ($conn->query($delete_query) === TRUE) {
        echo "<div class='alert alert-success'>Record deleted successfully from $table.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting record: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Manage Users</h3>

<!-- CSV Upload Form -->
<form method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
    <div class="col-md-3">
        <label>Select Table</label>
        <select name="table" class="form-select" required>
            <option value="s_db">s_db (Students)</option>
            <option value="r_db">r_db (Rectors)</option>
            <option value="p_db">p_db (Parents)</option>
        </select>
    </div>
    <div class="col-md-4">
        <label>Upload CSV</label>
        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" name="upload_csv" class="btn btn-primary">Upload</button>
    </div>
</form>

<!-- Navigation Tabs -->
<ul class="nav nav-pills mb-3">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#sdb">s_db</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#rdb">r_db</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#pdb">p_db</a></li>
</ul>

<!-- Table Data -->
<div class="tab-content">
    <?php
    $tables = ['s_db', 'r_db', 'p_db'];
    foreach ($tables as $index => $tbl) {
        $active = $index === 0 ? 'active' : '';
        echo "<div class='tab-pane fade show $active' id='" . str_replace('_', '', $tbl) . "'>";
        echo "<h5>Table: $tbl</h5>";
        
        $result = $conn->query("SELECT * FROM $tbl LIMIT 100");
        if ($result && $result->num_rows > 0) {
            echo "<div class='table-responsive'><table class='table table-bordered table-striped'>";
            echo "<thead><tr>";
            
            while ($fieldinfo = $result->fetch_field()) {
                echo "<th>{$fieldinfo->name}</th>";
            }
            echo "<th>Actions</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                // Action Buttons (Edit and Delete)
                echo "<td>
                        <a href='edit_user.php?table=$tbl&enroll={$row['Enrollment_No']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='?delete={$row['Enrollment_No']}&table=$tbl' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "<div class='alert alert-warning'>No data available in $tbl.</div>";
        }
        echo "</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
