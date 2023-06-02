$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var createImagePlugin = new KTImageInput('createImagePlugin');
    var updateImagePlugin = new KTImageInput('updateImagePlugin');

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
            url = $('#filterUrl').data('url') + '?' + $('#certificate_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table_data').html(response)
                window.history.pushState(null, null, url);
            }
        });

    }

    /* Форма */
    $(document).on('change', '#certificate_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Назва */
    $(document).on('keyup', '#name', function (e) {
        e.preventDefault();
        request();
    });

    /* Обновлено */
    $(document).on('keyup', '#date', function (e) {
        e.preventDefault();
        request();
    });

    /* Статус */
    $(document).on('change', '.status', function (e) {
        e.preventDefault();
        request();
    });

    /** Чекбокс */
    $(document).on('click', '#checkbox-all', function (e) {
        let isChecked = $(this)[0].checked
        if (isChecked) {
            $('.checkbox-item').prop('checked', true);
        } else {
            $('.checkbox-item').prop('checked', false);
        }
    });

    /** Показ сертифікатів */
    $(document).on('click', '.updateCertificateBtn', function (e) {
        let certificate_id = $(this).data('id');

        $.ajax({
            type: 'get',
            url: 'certificate/show',
            data: {
                certificate_id: certificate_id
            },
            success: function (response) {
                let certificate = response.certificate;

                $('#certificate_id').val(certificate.id);
                $('#title').val(certificate.title);
                $('#description').val(certificate.description);
                $('#status').val(certificate.status);
                $('#status').selectpicker('refresh');
                $('#cost').val(certificate.cost);
                $('#key').val(certificate.key);

                $('#updateImagePlugin').css('background-image', 'url("' + certificate.image + '")');
                $('#updateCertificateModal').modal('show');
            },
        })
    });

    /** Масове видалення сертифікатів */
    $(document).on('click', '.deletedCertificate', function (e) {
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_delete-certificate',
            data: {
                csrf: csrf,
                checkbox: checkbox,
            },
            dataType: "json",
            success: function (response) {
                let status = response.status;
                let certificates = response.certificates;
                let message = response.message;

                if (status) {
                    certificates.forEach(function (id) {
                        $('#certificate_' + id).remove();
                    });

                    toastr.success(message);
                }
            }
        });
    });

    /** Активація/Деактивація сертифікатів */
    $(document).on('click', '.activeCertificate', function (e) {

        let status = $(this).data('status');
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_active-certificate',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let certificates = response.certificates;
                let title = response.title;
                let message = response.message;

                certificates.forEach(function (id) {
                    $('#certificate_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                    $('#checkbox-all').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });

    /** Сортування сертифікатів */
    function sortCertificate() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let lang = $('meta[name="lang"]').attr('content');
        let tbody = document.querySelector('tbody')
        new Sortable(tbody, {
            animation: 150,
            handle: '.handle',
            dragClass: 'table-sortable-drags',
            onEnd: function () {

                var list = [];
                $.each($('tbody tr'), function (idx, el) {
                    list.push({
                        id: $(el).data('id'),
                        pos: idx + 1
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '/' + lang + '/admin/_update-certificate-position',
                    data: {
                        positions: list,
                    },
                    success: function (response) {

                    }
                });
            }
        });
    }

    sortCertificate();
});
