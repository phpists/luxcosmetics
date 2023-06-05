$(document).ready(function () {

    function numberSelected() {
        var data = $('#users_form').serializeArray();
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
            url = $('#filterUrl').data('url') + '?' + $('#users_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.usersHtml);
                $('#pagination').html(response.paginateHtml);
            }
        });
    }

    /* Id */
    $(document).on('keyup', '#id', function (e) {
        e.preventDefault();
        request();
    });

    /* Email */
    $(document).on('keyup', '#email', function (e) {
        e.preventDefault();
        request();
    });

    /* Name */
    $(document).on('keyup', '#name', function (e) {
        e.preventDefault();
        request();
    });

    /* Last name */
    $(document).on('keyup', '#last_name', function (e) {
        e.preventDefault();
        request();
    });

    /* Phone */
    $(document).on('keyup', '#phone', function (e) {
        e.preventDefault();
        request();
    });

    /* Last active */
    $(document).on('keyup', '#last_active', function (e) {
        e.preventDefault();
        request();
    });

    /* Created_at */
    $(document).on('keyup', '#created_at', function (e) {
        e.preventDefault();
        request();
    });

    /* Статус */
    $(document).on('change', '.status', function (e) {
        e.preventDefault();
        request();
    });

});
