$(document).ready(function () {

    function numberSelected() {
        var data = $('#orders_form').serializeArray();
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
            url = $('#filterUrl').data('url') + '?' + $('#orders_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.ordersHtml);
                $('#pagination').html(response.paginateHtml);
            }
        });
    }

    /* Id */
    $(document).on('keyup', '#id', function (e) {
        e.preventDefault();
        request();
    });

    /* Phone */
    $(document).on('keyup', '#phone', function (e) {
        e.preventDefault();
        request();
    });

    /* Користувач */
    $(document).on('keyup', '#name', function (e) {
        e.preventDefault();
        request();
    });

    /* Всього до оплати */
    $(document).on('keyup', '#total_sum', function (e) {
        e.preventDefault();
        request();
    });

    /* Статус */
    $(document).on('change', '.status', function (e) {
        e.preventDefault();
        request();
    });




});
