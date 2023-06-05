$(document).ready(function () {

    function numberSelected() {
        var data = $('#blog_form').serializeArray();
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
            url = $('#filterUrl').data('url') + '?' + $('#blog_form').serialize();
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

    /* Title */
    $(document).on('keyup', '#title', function (e) {
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

    /* Published_at */
    $(document).on('keyup', '#published_at', function (e) {
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

    /* Масове видалення статей */
    $(document).on('click', '.deletedPosts', function (e) {
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_delete-posts',
            data: {
                csrf: csrf,
                checkbox: checkbox,
            },
            dataType: "json",
            success: function (response) {
                let status = response.status;
                let posts = response.posts;
                let message = response.message;

                if (status) {
                    posts.forEach(function (id) {
                        $('#post_' + id).remove();
                    });

                    toastr.success(message);
                }
            }
        });
    });

    /**
     * Активація/Деактивація статей
     */
    $(document).on('click', '.activePost', function (e) {

        let status = $(this).data('status');
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_active-posts',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let posts = response.posts;
                let title = response.title;
                let message = response.message;

                posts.forEach(function (id) {
                    $('#post_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });


});
