$(document).ready(function () {

    function numberSelected() {

        var data = $('#product_form').serializeArray();

        var counts = [];

        data.forEach(function (element) {
            if (!counts[element.name]) {
                counts[element.name] = 0;
            }
            counts[element.name] += 1;
        });

    }

    function request(url) {

        numberSelected();

        if (typeof url === 'undefined') {
            url = $('#filterUrl').data('url') + '?' + $('#product_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.productsHtml);
                $('#pagination').html(response.paginateHtml);

                window.history.pushState(null, null, url);
            }
        });

    }

    /* Форма */
    $(document).on('change', '#product_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Кнопка */
    $(document).on('click', '.btn_product_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Поле продуку */
    $(document).on('keyup', '#product_id', function (e) {
        e.preventDefault();
        request();
    });

    /* Код */
    $(document).on('keyup', '#code', function (e) {
        e.preventDefault();
        request();
    });

    /* Key */
    $(document).on('keyup', '#key', function (e) {
        e.preventDefault();
        request();
    });

    /* Name */
    $(document).on('keyup', '#name', function (e) {
        e.preventDefault();
        request();
    });

    /* Статус */
    $(document).on('change', '.status', function (e) {
        e.preventDefault();
        request();
    });

    /* Категорія */
    $(document).on('keyup', '.category', function (e) {
        e.preventDefault();
        request();
    });

    /* Ціна */
    $(document).on('keyup', '#price', function (e) {
        e.preventDefault();
        request();
    });

    /* Пагінація */
    $(document).on('change', '#paginate', function (e){
        console.log('paginate');
        e.preventDefault();
        request();
    });

    /* Чекбокс */
    $(document).on('click', '#checkbox-all', function (e) {
        let isChecked = $(this)[0].checked
        if (isChecked) {
            $('.checkbox-item').prop('checked', true);
        } else {
            $('.checkbox-item').prop('checked', false);
        }
    });

    /* Масове видалення товарів */
    $(document).on('click', '.deletedProducts', function (e) {
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_delete-products',
            data: {
                csrf: csrf,
                checkbox: checkbox,
            },
            dataType: "json",
            success: function (response) {
                let status = response.status;
                let products = response.products;
                let message = response.message;

                if (status) {
                    products.forEach(function (id) {
                        $('#product_' + id).remove();
                    });

                    toastr.success(message);
                }
            }
        });
    });


    /**
     * Активація/Деактивація товарів
     */
    $(document).on('click', '.activeProducts', function (e) {

        let status = $(this).data('status');
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_active-products',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let products = response.products;
                let title = response.title;
                let message = response.message;

                products.forEach(function (id) {
                    $('#product_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });


});
