let setCooldownInterval;

$.fn.setCooldown = function(time = 5) {
    let seconds = Math.ceil(time); // Calculate the number of seconds

    return $(this).each(function() {
        if (setCooldownInterval !== undefined)
            return;

        $(this).attr('disabled', true);
        let disabledElem = $(this),
            originalText = disabledElem.text().split(' (').shift().trim(); // Remember the original text content

        // append the number of seconds to the text
        disabledElem.text(originalText + ' (' + seconds + ')');

        // do a set interval, using an interval of 1000 milliseconds
        //     and clear it after the number of seconds counts down to 0
        setCooldownInterval = setInterval(function() {
            seconds = seconds - 1;
            // decrement the seconds and update the text
            disabledElem.text(originalText + ' (' + seconds + ')');
            if (seconds === 0) { // once seconds is 0...
                disabledElem.removeAttr('disabled')
                    .text(originalText); //reset to original text
                clearInterval(setCooldownInterval); // clear interval
                setCooldownInterval = undefined;
            }
        }, 1000);
    });
};

$(function () {

    initCatalogItems()

    $('[data-modal]').on('click', function () {
        const modal = this.dataset.modal;
        $.magnificPopup.open({
            items: {
                src: modal,
                type: 'inline'
            }
        });
    })

    validationStuff.init();
})

function openModal(modal) {
    $.magnificPopup.open({
        items: {
            src: modal,
            type: 'inline'
        }
    });
}


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

function submitLiveForm($form, callback = undefined) {
    fetch($form.attr('action'), {
            method: $form.attr('method'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: $form.serialize(),
            redirect: 'follow',
        })
        .then(async response => {
            if (response.redirected) {
                window.location.replace(response.url);
                return;
            }

            let json = await response.json();

            if (response.status === 500)
                throwMessage('ОШИБКА! Попробуйте позже')

            if (response.status === 429)
                throwMessage('Воу, не так быстро! Подождите немного')

            if (response.status === 422)
                validationStuff.showErrors(json.errors, $form.data('feedback-class'))

            if (response.status === 200 || response.status === 201 || response.status === 202) {
                if (json.redirect_url)
                    window.location.replace(json.redirect_url);

                if (json.message)
                    throwMessage(json.message)
            }

            if (typeof callback === 'function')
                callback(response, json);
        })
}

const validationStuff = {
    init: function () {
        const self = this;

        $(document).on('input', '.is-invalid', function (e) {
            self.hideErrors(this)
        });

        $(document).on('change', '.is-invalid', function (e) {
            self.hideErrors(this)
        });
    },
    showErrors: (errors, feedbackClass = 'invalid-feedback') => {
        for (let name in errors) {
            const $el = $(`[name=${name}]:not(:hidden)`).addClass('is-invalid');
            if ($el.next().hasClass(feedbackClass))
                $el.next().text(errors[name].join(' | '))
            else
                $el.after(`<span class="${feedbackClass}">${errors[name].join(' | ')}</span>`)
        }
    },
    hideErrors: (el = null) => {
        if (el)
            $(el).removeClass('is-invalid');
        else
            $('.is-invalid').removeClass('is-invalid');
    }
}
