<?php
$conn = new mysqli("localhost", "root", "", "gatepass");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = $_GET['table'] ?? '';
$enroll = $_GET['enroll'] ?? '';

if (!$table || !$enroll) {
    echo "Invalid request.";
    exit;
}

if ($table == 's_db') {
    $id_column = 'Enrollment_No';
} elseif ($table == 'r_db') {
    $id_column = 'id';
} elseif ($table == 'p_db') {
    $id_column = 'Pr_Email';
} else {
    echo "Invalid table.";
    exit;
}

$sql = "SELECT * FROM `$table` WHERE `$id_column` = '$enroll'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "User not found.";
    exit;
}
$user = $result->fetch_assoc();

if (isset($_POST['update'])) {
    if ($table == 's_db') {
        $fields = [
            'SurName', 'Student_Name', 'Father_Name', 'Enrollment_No', 'Email_id', 'S_contact_No', 'Password',
            'Institute', 'Batch', 'Department', 'Hostel_Block_No', 'Hostel_Room_No', 'Address_Line1', 'Address_Line2',
            's_DOB', 'P_Full_Name', 'P_contact_No_1', 'P_contact_No_2', 'P_email_id', 'Status'
        ];
    } elseif ($table == 'r_db') {
        $fields = [
            'full_name', 'designation', 'department', 'email', 'phone', 'alt_phone', 'gender', 'address',
            'dob', 'aadhar', 'joining_date', 'blood_group', 'qualification', 'experience', 
            'emergency_contact', 'shift', 'hostel_block', 'remarks'
        ];
    } elseif ($table == 'p_db') {
        $fields = [
            'Pr_Name', 'Pr_Email', 'Pr_Contact No.', 'Department', 'password'
        ];
    }

    $update_fields = [];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $conn->real_escape_string($_POST[$field]);
            $update_fields[] = "`$field`='$value'";
        }
    }

    $update_sql = "UPDATE `$table` SET " . implode(", ", $update_fields) . " WHERE `$id_column` = '$enroll'";

    if ($conn->query($update_sql)) {
        echo "<div class='alert alert-success'>User updated successfully. <a href='admin.php'>Go Back</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Update failed: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit User (Table: <?= htmlspecialchars($table) ?>)</h3>
    <form method="POST" class="row g-3">
        <?php
        if ($table == 's_db') {
            $fields = [
                'SurName', 'Student_Name', 'Father_Name', 'Enrollment_No', 'Email_id', 'S_contact_No', 'Password',
                'Institute', 'Batch', 'Department', 'Hostel_Block_No', 'Hostel_Room_No', 'Address_Line1', 'Address_Line2',
                's_DOB', 'P_Full_Name', 'P_contact_No_1', 'P_contact_No_2', 'P_email_id', 'Status'
            ];
        } elseif ($table == 'r_db') {
            $fields = [
                'full_name', 'designation', 'department', 'email', 'phone', 'alt_phone', 'gender', 'address',
                'dob', 'aadhar', 'joining_date', 'blood_group', 'qualification', 'experience', 
                'emergency_contact', 'shift', 'hostel_block', 'remarks'
            ];
        } elseif ($table == 'p_db') {
            $fields = [
                'Pr_Name', 'Pr_Email', 'Pr_Contact No.', 'Department', 'password'
            ];
        }

        foreach ($fields as $field) {
            $type = (strpos(strtolower($field), 'date') !== false || strtolower($field) == 'dob') ? 'date' : 
                    ((strpos(strtolower($field), 'email') !== false) ? 'email' : 'text');
            $value = isset($user[$field]) ? htmlspecialchars($user[$field]) : '';
            echo "<div class='col-md-6'>
                    <label class='form-label'>".str_replace("_", " ", $field)."</label>
                    <input type='$type' name='$field' class='form-control' value='$value' required>
                  </div>";
        }
        ?>
        <div class="col-12">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="admin.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
