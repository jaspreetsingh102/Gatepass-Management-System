// You can add JavaScript functionality here for handling dropdown changes and button clicks.

document.getElementById('userDropdown').addEventListener('change', function() {
    console.log('User changed to:', this.value);
    // Add logic to update content based on user selection
});

document.getElementById('roomDetailDropdown').addEventListener('change', function() {
    console.log('Room detail selected:', this.value);
    // Add logic to fetch and display room details
});

document.getElementById('gatePassDropdown').addEventListener('change', function() {
    console.log('Gate pass request selected:', this.value);
    // Add logic to fetch and display gate pass requests
});

document.getElementById('checkOutsideButton').addEventListener('click', function() {
    console.log('Check outside students clicked');
    // Add logic to check students outside the gate
});

document.getElementById('allStudentButton').addEventListener('click', function() {
    console.log('All student details clicked');
    // Add logic to fetch and display all student details
});

document.addEventListener("DOMContentLoaded", function () {
    const roomDetailDropdown = document.getElementById("roomDetailDropdown");

    roomDetailDropdown.addEventListener("change", function () {
        const selectedRoom = this.value;

        // Fetch filtered student data
        fetch(`fetch_students.php?room=${selectedRoom}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector(".excel-container table").innerHTML = data;
            })
            .catch(error => console.error("Error fetching student data:", error));
    });
});

