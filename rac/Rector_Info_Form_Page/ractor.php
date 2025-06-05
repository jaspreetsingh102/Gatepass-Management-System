<?php
// rector.php
$rector = [
    'rectorId' => '23172022015',
    'name' => 'PATEL JAYDEEP BIPINCHANDRA',
    'email' => 'jaydeeppatel20@gnu.ac.in',
    'contact' => '+91XXXXXXXXXX',
    'city' => '',
    'country' => 'India',
    'description' => ''
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rector Information</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-container">
    <h4 class="mb-4 text-center">Rector Information</h4>
    <form>
        <div class="form-group">
            <label for="rectorId"><strong>Rector ID:</strong></label>
            <input type="text" class="form-control" id="rectorId" value="<?php echo $rector['rectorId']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="name"><strong>Full Name:</strong></label>
            <input type="text" class="form-control" id="name" value="<?php echo $rector['name']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email"><strong>Email:</strong></label>
            <input type="email" class="form-control" id="email" value="<?php echo $rector['email']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="contact"><strong>Contact Number:</strong></label>
            <input type="text" class="form-control" id="contact" value="<?php echo $rector['contact']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="city"><strong>City/Town:</strong></label>
            <input type="text" class="form-control" id="city" value="<?php echo $rector['city'] ?: 'N/A'; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="country"><strong>Country:</strong></label>
            <input type="text" class="form-control" id="country" value="<?php echo $rector['country']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="description"><strong>Description:</strong></label>
            <textarea class="form-control" id="description" rows="4" readonly><?php echo $rector['description'] ?: 'N/A'; ?></textarea>
        </div>
    </form>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="script.js"></script>
</body>
</html>
