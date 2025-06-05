// Function to Scroll Left
function scrollLeft() {
    document.getElementById("scrollContainer").scrollBy({ left: -100, behavior: "smooth" });
}

// Function to Scroll Right
function scrollRight() {
    document.getElementById("scrollContainer").scrollBy({ left: 100, behavior: "smooth" });
}

// Function to Scroll Up
function scrollUp() {
    document.getElementById("scrollContainer").scrollBy({ top: -100, behavior: "smooth" });
}

// Function to Scroll Down
function scrollDown() {
    document.getElementById("scrollContainer").scrollBy({ top: 100, behavior: "smooth" });
}