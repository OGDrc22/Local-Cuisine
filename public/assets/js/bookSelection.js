document.addEventListener('DOMContentLoaded', function () {
    const routeTemplate = document.querySelector('meta[name="route-tempate"]').content;
    document.querySelectorAll('.book-item').forEach(item => {
        item.addEventListener('click', function () {
            const bookId = this.getAttribute('data-id');
            const finalUrl = routeTemplate.replace('__ID__', bookId);
            window.location.href = finalUrl;
        })
    });
})