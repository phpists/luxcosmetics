$(document).ready(function () {

`    function numberSelected() {

        var data = $('#certificate_form').serializeArray();

        var counts = [];

        data.forEach(function (element) {
            if (!counts[element.name]) {
                counts[element.name] = 0;
            }
            counts[element.name] += 1;
        });
    }`

    function request(url) {

        numberSelected();

        if (typeof url === 'undefined') {
            url = $('#filterUrl').data('url') + '?' + $('#categories_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.categoriesAjaxHtml);
                $('#pagination').html(response.paginateHtml);
                window.history.pushState(null, null, url);
            }
        });

    }
    function request(url) {

        numberSelected();

        if (typeof url === 'undefined') {
            url = $('#filterUrl').data('url') + '?' + $('#categories_form').serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table').html(response.categoriesAjaxHtml);
                $('#pagination').html(response.paginateHtml);

                window.history.pushState(null, null, url);
            }
        });

    }

    /* Форма */
    $(document).on('change', '#categories_form', function (e) {
        e.preventDefault();
        request();
    });

    /* Назва */
    $(document).on('keyup', '#name', function (e) {
        e.preventDefault();
        request();
    });

    /* Аліас */
    $(document).on('keyup', '#alias', function (e) {
        e.preventDefault();
        request();
    });

    /* Артикул */
    $(document).on('keyup', '#code', function (e) {
        e.preventDefault();
        request();
    });

    /* Статус */
    $(document).on('change', '.status', function (e) {
        e.preventDefault();
        request();
    });

    /* Категория */
    $(document).on('change', '#cat_select', function (e) {
        e.preventDefault();
        request();
    });

    /* Пагінація */
    $(document).on('change', '#paginate', function (e) {
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

    /* Масове видалення категорій */
    $(document).on('click', '.deletedCategories', function (e) {
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_delete-categories',
            data: {
                csrf: csrf,
                checkbox: checkbox,
            },
            dataType: "json",
            success: function (response) {
                let status = response.status;
                let categories = response.categories;
                let message = response.message;

                if (status) {
                    categories.forEach(function (id) {
                        $('#category_' + id).remove();
                    });

                    toastr.success(message);
                }
            }
        });
    });

    /**
     * Активація/Деактивація категорій
     */
    $(document).on('click', '.activeCategories', function (e) {

        let status = $(this).data('status');
        let lang = $('meta[name="lang"]').attr('content');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/' + lang + '/admin/_active-categories',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let categories = response.categories;
                let title = response.title;
                let message = response.message;

                categories.forEach(function (id) {
                    $('#category_' + id).find('.status').text(title);
                    $('.checkbox-item').prop('checked', false);
                });
                toastr.success(message);
            }
        });

    });

    /**
     * Сортування категорій
     */
    function sortCtegorties() {
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
                    url: '/' + lang + '/admin/_update-categories-position',
                    data: {
                        positions: list,
                    },
                    success: function (response) {

                    }
                });
            }
        });
    }

    sortCtegorties();


    function editCategoryImage(data) {

        let id = $(data).data('id');
        let lang = $('meta[name="lang"]').attr('content');
        console.log('some', lang);
        $.ajax({
            url: '/' + lang + '/admin/_category/show/image',
            data: {
                'id': id
            },
            success: function (response) {
                let image = response.category_image

                console.log('sss', image.path);
                $('#imageId').val(image.id);
                $('.categoryImage').css('background-image', 'url(' + image.path + ')');
                $('#is_main').find('option[value="' + image.is_main + '"]').attr("selected", "selected");
                $('#active').find('option[value="' + image.active + '"]').attr("selected", "selected");
                $('#title').val(image.title);
                $('#alt').val(image.alt);


            }, error: function (response) {
                console.log(response)
            }
        });
    };

    $(document).on('click', '.updateCategoryImage', function () {
        editCategoryImage(this);
    });

    /**
     * Сортування зображень категорій
     */
    function sortCtegortiesImage() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let lang = $('meta[name="lang"]').attr('content');
        let tbody = document.querySelector('tbody')
        new Sortable(tbody, {
            animation: 150,
            handle: '.handle_cat_image',
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
                    url: '/' + lang + '/admin/_update-categories-image-position',
                    data: {
                        positions: list,
                    },
                    success: function (response) {

                    }
                });
            }
        });
    }

    sortCtegortiesImage();


});
