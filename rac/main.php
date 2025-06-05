<?php
// ... (Database connection code)

// Example: Fetching room details from a database
$roomDetails = []; // Fetch from database
foreach ($roomDetails as $room) {
    echo '<option value="' . $room['id'] . '">' . $room['name'] . '</option>';
}
?>