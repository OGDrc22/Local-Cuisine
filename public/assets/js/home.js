document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);

    const show_hide_btn = document.getElementById('show_hide_btn');
    const user_books = document.getElementById('user_books');
    show_hide_btn.addEventListener('click', function() {
        if (show_hide_btn.textContent == 'Show') {
            show_hide_btn.textContent = 'Hide';
        } else {
            show_hide_btn.textContent = 'Show';
        }
    })




});