// Ждем, пока загрузится весь документ
jQuery(document).ready(function($) {
    // Пример: добавляем класс к body при прокрутке страницы
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('body').addClass('scrolled');
        } else {
            $('body').removeClass('scrolled');
        }
    });

    // Пример: обработка клика по кнопке с классом 'toggle-menu'
    $('.toggle-menu').click(function() {
        $('.main-menu').toggleClass('visible');
    });

    // Пример: выводим сообщение в консоль
    console.log('Основной файл JS подключен успешно!');
});