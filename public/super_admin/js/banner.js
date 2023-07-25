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
            url = $('#filterUrl').data('url') + '?' + $('#banner_form').serialize();
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

    $(document).on('change', '#banner_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Позиція */
    $(document).on('change', '#position', function (e) {
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
     * Активація/Деактивація статей
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
        url: '/admin/_active-posts',
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
                        $('#banner_' + k).find('.status').html('<span>'+title+'</span>');
                    }
                }
                toastr.success(message);
                location.reload();
            }
        });
    });

    let tbody = document.querySelector('tbody');
    new Sortable(tbody, {
        animation: 150,
        handle: '.handle',
        dragClass: 'table-sortable-drag',
        onEnd: function (/**Event*/ evt) {
            console.log('drop');
            var list = [];
            $.each($('tbody tr'), function (idx, el) {
                list.push({
                    id: $(el).data('id'),
                    pos: idx + 1
                })
            });

            $('.left-btn').click(function() {
                var id = $(this).data('id');
                var pos = $(this).data('pos');
                pos--;
                $(this).data('pos', pos).siblings('.number-position').text(pos);
            });

            $('.right-btn').click(function() {
                var id = $(this).data('id');
                var pos = $(this).data('pos');
                pos++;
                $(this).data('pos', pos).siblings('.number-position').text(pos);
            });

            $.ajax({
                method: 'post',
                url: '{{ route("admin.banner_method.update_positions") }}',
                data: {
                    positions: list,
                },
                success: function (response) {
                    console.log(response)
                    $.each(response, function(i, item) {
                        $(`tr[data-id="${i}"]`).find('.position').text(item)
                    })
                }
            });
        }
    });
});
