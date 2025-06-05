document.addEventListener("DOMContentLoaded", function() {
    const sidebarItems = document.querySelectorAll(".sidebar ul li");
    const logoutButton = document.querySelector(".logout");

    sidebarItems.forEach(item => {
        item.addEventListener("click", function() {
            alert(`You clicked on ${this.textContent}`);
        });
    });

    logoutButton.addEventListener("click", function() {
        alert("Logging out...");
        window.location.href = "login.html";
    });
});

document.getElementById('download-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const gatePassBox = document.querySelector('.gate-pass-box');
    const content = gatePassBox.innerHTML;

    doc.fromHTML(content, 10, 10);
    doc.save('gate-pass.pdf');
});