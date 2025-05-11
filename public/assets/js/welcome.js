document.addEventListener('DOMContentLoaded', function () {
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

