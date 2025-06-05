<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gatepass";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$full_name = $designation = $department = $email = $phone = $alt_phone = $gender = $address = "";
$dob = $aadhar = $joining_date = $blood_group = $qualification = $experience = $emergency_contact = $shift = $hostel_block = $remarks = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $joining_date = $_POST['joining_date'];
    $blood_group = $_POST['blood_group'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $emergency_contact = $_POST['emergency_contact'];
    $shift = $_POST['shift'];
    $hostel_block = $_POST['hostel_block'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO r_db (
        full_name, designation, department, email, phone, alt_phone, gender, address,
        dob, aadhar, joining_date, blood_group, qualification, experience,
        emergency_contact, shift, hostel_block, remarks
    ) VALUES (
        '$full_name', '$designation', '$department', '$email', '$phone', '$alt_phone', '$gender', '$address',
        '$dob', '$aadhar', '$joining_date', '$blood_group', '$qualification', '$experience',
        '$emergency_contact', '$shift', '$hostel_block', '$remarks'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:lime;'>Rector info inserted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Fetch records
$result = $conn->query("SELECT * FROM r_db");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rector Information</title>
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            font-family: 'Arial', sans-serif;
            color: white;
            padding: 30px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            width: 600px;
            margin-bottom: 30px;
        }

        h2, h3 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        input[type="submit"] {
            background: #4CAF50;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            color: black;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #444;
            color: white;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Rector Information Form</h2>
    <form method="POST">
        <div class="form-group"><label>Full Name:</label><input type="text" name="full_name" value="<?= $full_name ?>" required></div>
        <div class="form-group"><label>Designation:</label><input type="text" name="designation" value="<?= $designation ?>" required></div>
        <div class="form-group"><label>Department:</label><input type="text" name="department" value="<?= $department ?>" required></div>
        <div class="form-group"><label>Email:</label><input type="email" name="email" value="<?= $email ?>" required></div>
        <div class="form-group"><label>Phone:</label><input type="text" name="phone" value="<?= $phone ?>" required></div>
        <div class="form-group"><label>Alternate Phone:</label><input type="text" name="alt_phone" value="<?= $alt_phone ?>"></div>
        <div class="form-group"><label>Gender:</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                <option <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                <option <?= $gender == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        <div class="form-group"><label>Address:</label><textarea name="address"><?= $address ?></textarea></div>
        <div class="form-group"><label>Date of Birth:</label><input type="date" name="dob" value="<?= $dob ?>" required></div>
        <div class="form-group"><label>Aadhar No.:</label><input type="text" name="aadhar" value="<?= $aadhar ?>" required></div>
        <div class="form-group"><label>Joining Date:</label><input type="date" name="joining_date" value="<?= $joining_date ?>" required></div>
        <div class="form-group"><label>Blood Group:</label><input type="text" name="blood_group" value="<?= $blood_group ?>" required></div>
        <div class="form-group"><label>Qualification:</label><input type="text" name="qualification" value="<?= $qualification ?>" required></div>
        <div class="form-group"><label>Experience (Years):</label><input type="number" step="0.1" name="experience" value="<?= $experience ?>" required></div>
        <div class="form-group"><label>Emergency Contact:</label><input type="text" name="emergency_contact" value="<?= $emergency_contact ?>" required></div>
        <div class="form-group"><label>Shift:</label><input type="text" name="shift" value="<?= $shift ?>" required></div>
        <div class="form-group"><label>Hostel Block:</label><input type="text" name="hostel_block" value="<?= $hostel_block ?>" required></div>
        <div class="form-group"><label>Remarks:</label><textarea name="remarks"><?= $remarks ?></textarea></div>
        <input type="submit" value="Submit">
    </form>
</div>

