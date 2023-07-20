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
            url = $('#filterUrl').data('url') + '?' + $('#news_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.bannerAjaxHtml);
                $('#pagination').html(response.paginateHtml);
                window.history.pushState(null, null, url);
            }
        });

    }

    $(document).on('change', '#news_form', function (e) {
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

    /**
     * Активація/Деактивація новин
     */

    $(document).on('click', '.activePost', function (e) {
        let status = $(this).data('status');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let id = $(this).closest('tr').data('id');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

    $.ajax({
        type: "POST",
        url: '/admin/_active-posts-news',
        data: {
            csrf: csrf,
            id: id,
            checkbox: checkbox,
            status: status,
        },
            success: function (response) {
                let posts = response.posts;
                var s = JSON.parse(response);
                for(i in s) {
                    var title = s.title;
                    var message = s.message;
                    for( k in s.posts ) {
                        $('#post_' + k).find('.status').html('<span>'+title+'</span>');
                    }
                }
                toastr.success(message);
                location.reload();
            }
        });
    });



});
