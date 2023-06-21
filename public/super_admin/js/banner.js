$(document).ready(function () {


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
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/admin/_active-posts',
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
                    $('#banner_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });


});
