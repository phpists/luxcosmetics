$(document).ready(function () {

    function numberSelected() {

        var data = $('#certificate_form').serializeArray();

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
            url = $('#filterUrl').data('url') + '?' + $('#comment_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.commentAjaxHtml);
                $('#pagination').html(response.paginateHtml);
                window.history.pushState(null, null, url);
            }
        });

    }

    $(document).on('change', '#comment_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Позиція */
    $(document).on('change', '#status', function (e) {
        e.preventDefault();
        request();
    });

});
