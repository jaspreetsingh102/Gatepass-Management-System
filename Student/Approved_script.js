document.addEventListener('DOMContentLoaded', () => {
    const logoutButton = document.querySelector('.logout');
    logoutButton.addEventListener('click', () => {
        alert('Logging out...');
    });
});