document.addEventListener('DOMContentLoaded', function () {
    const routeTemplate = document.querySelector('meta[name="route-tempate"]').content;
    document.querySelectorAll('.book-item').forEach(item => {
        console.log("Cilcked !!")
        item.addEventListener('click', function () {
            const bookId = this.getAttribute('data-id');
            const finalUrl = routeTemplate.replace('__ID__', bookId);
            window.location.href = finalUrl;
        })
    });

    const search_container_width = window.getComputedStyle(document.querySelector('.container-Search')).width;
    const img = document.querySelector('.imageBg');
    console.log(search_container_width);
    if (search_container_width != null) {
        img.classList.add = 'd-none';
        img.style.display = 'none';
        console.log(img, ' hide');
    } else {
        img.classList.remove = 'd-none';
    }
});