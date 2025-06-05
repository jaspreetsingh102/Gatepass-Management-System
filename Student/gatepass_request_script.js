document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll("nav ul li");
    const logoutBtn = document.querySelector(".logout");
    const submitBtn = document.querySelector(".submit");

    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            alert("You clicked: " + this.innerText);
        });
    });

    logoutBtn.addEventListener("click", function() {
        alert("Logging out...");
    });

    submitBtn.addEventListener("click", function() {
        alert("Leave request submitted!");
    });
});