$(function () {

    initCatalogItems()

})


function initFilters() {

    $(".filters").mCustomScrollbar({
        axis: "y",              // вертикальный скролл
        theme: "dark",  // тема
        scrollInertia: "330",   // продолжительность прокрутки, значение в миллисекундах
        setHeight: "100%",      // высота блока (переписывает CSS)
        mouseWheel: {
            deltaFactor: 300    // кол-во пикселей на одну прокрутку колёсика мыши
        }
    });

    $(".btnfilters").click(function () {
        $("#filters").addClass("is-active");
        $(".filters-overlay").addClass("is-active");
    });

    $(".filters-overlay").click(function () {
        $(this).removeClass("is-active");
        $("#filters").removeClass("is-active");
        $(".sortmobile").removeClass("is-active");
    });

    $(".filters__close").click(function () {
        $(".filters-overlay").removeClass("is-active");
        $("#filters").removeClass("is-active");
    });

    $(".btnsort").click(function () {
        $(".sortmobile").addClass("is-active");
        $(".filters-overlay").addClass("is-active");
    });
    $(".sortmobile__close").click(function () {
        $(".filters-overlay").removeClass("is-active");
        $(".sortmobile").removeClass("is-active");
    });
}

function throwMessage(message) {
    const $toast = $('#fav_alert').clone();
    $toast.text(message);

    $('body').append($toast)
    $toast.fadeIn(function () {
        setTimeout(() => {
            $toast.fadeOut(function () {
                $toast.remove();
            });
        }, 2000)
    })
}

function initCatalogItems() {
    // Получаем все элементы .catitem на странице
    const catItems = document.querySelectorAll('.catitem');

    // Проверяем наличие элементов
    if (catItems.length > 0) {
        catItems.forEach(catItem => {
            const links = catItem.querySelectorAll('.catitem__link');
            const content = catItem.querySelector('.catitem__content');

            // Если количество ссылок больше 6, добавляем кнопку и скрываем лишние ссылки
            if (links.length > 6) {
                // Создаем кнопку "Показать еще"
                const moreButton = document.createElement('button');
                moreButton.className = 'catitem__more';
                moreButton.textContent = 'Показать еще';
                content.appendChild(moreButton);

                // Скрываем ссылки, начиная с 7-й
                links.forEach((link, index) => {
                    if (index >= 6) {
                        link.style.display = 'none';
                    }
                });

                // Добавляем обработчик клика на кнопку
                moreButton.addEventListener('click', function () {
                    const hiddenLinks = Array.from(links).slice(6);
                    const isHidden = hiddenLinks.some(link => link.style.display === 'none');

                    // Переключаем видимость ссылок
                    hiddenLinks.forEach(link => {
                        link.style.display = isHidden ? 'block' : 'none';
                    });

                    // Меняем текст кнопки
                    moreButton.textContent = isHidden ? 'Скрыть' : 'Показать еще';
                });
            }
        });
    }
}
