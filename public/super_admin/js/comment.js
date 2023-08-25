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
                addStatusChange();
                $('.selectpicker').selectpicker();
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

    function addStatusChange() {
        $('.statusSelect').on('change', function() {
            const itemId = $(this).data('item-id');
            const selectedValue = $(this).val();
            let csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

            $.ajax({
                url: 'comment/_update',
                type: 'POST',
                data: {
                    item_id: itemId,
                    status: selectedValue,
                    csrf: csrf,
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    }

    $(document).ready(function() {
        addStatusChange()
    });


});
