document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.sale-products-container');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');

    if (!container || !leftArrow || !rightArrow) return;

    const itemWidth = container.firstElementChild ? container.firstElementChild.clientWidth + 20 : 250; // Учитываем gap между элементами

    leftArrow.addEventListener('click', function () {
        if (container.scrollLeft <= 0) {
            // Если достигнут самый левый край, переходим к последнему элементу
            container.scrollTo({
                left: container.scrollWidth,
                behavior: 'smooth'
            });
        } else {
            // Обычная прокрутка влево
            container.scrollBy({
                left: -itemWidth,
                behavior: 'smooth'
            });
        }
    });

    rightArrow.addEventListener('click', function () {
        if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
            // Если достигнут конец списка, плавно вернуться в начало
            container.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        } else {
            // Обычная прокрутка вправо
            container.scrollBy({
                left: itemWidth,
                behavior: 'smooth'
            });
        }
    });
});