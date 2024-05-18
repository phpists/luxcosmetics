$(function () {

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
