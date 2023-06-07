$(document).ready(function () {

    /* Масове видалення опцій догляду */
    $(document).on('click', '.deletedCares', function (e) {
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_delete-cares',
            data: {
                csrf: csrf,
                checkbox: checkbox,
            },
            dataType: "json",
            success: function (response) {
                let status = response.status;
                let cares = response.cares;
                let message = response.message;

                if (status) {
                    cares.forEach(function (id) {
                        $('#care_' + id).remove();
                    });

                    toastr.success(message);
                }
            }
        });
    });

    /**
     * Активація/Деактивація опцій догляду
     */
    $(document).on('click', '.activeCares', function (e) {

        let status = $(this).data('status');
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_active-cares',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let cares = response.cares;
                let title = response.title;
                let message = response.message;

                cares.forEach(function (id) {
                    $('#care_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });
});
