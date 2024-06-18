$(document).ready(function () {
    var KTSummernoteDemo = function () {
        // Private functions
        var demos = function () {
            $('.summernote').summernote({
                height: 450
            });
        }

        return {
            // public functions
            init: function () {
                demos();
            }
        };
    }();

    /* Menu Category */

    jQuery(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        KTSummernoteDemo.init();

        let lang = $('meta[name="lang"]').attr('content');
        let tbody = document.querySelector('#table_category_menu')
        new Sortable(tbody, {
            animation: 150,
            handle: '.handle',
            dragClass: 'table-sortable-drag',
            onEnd: function (evt) {
                var list = [];
                $.each($('#table_category_menu tr'), function (idx, el) {
                    list.push({
                        id: $(el).data('id'),
                        pos: idx + 1
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '/' + lang + '/admin/menu/category/update-positions',
                    data: {
                        positions: list,
                    },
                    success: function (response) {
                        console.log(response)
                    }
                });

            }
        });
    });


    function dualListbox() {
        var KTDualListbox = function () {
            // Private functions
            var demo1 = function () {
                // Dual Listbox
                var _this = document.getElementById('kt_dual_listbox_1');

                // init dual listbox
                var dualListBox = new DualListbox(_this, {
                    addEvent: function (value) {
                        console.log(value);
                    },
                    removeEvent: function (value) {
                        console.log(value);
                    },
                    availableTitle: 'Категорії',
                    selectedTitle: 'Підкатегорії',
                    addButtonText: 'Додаим',
                    removeButtonText: 'Видалити',
                    addAllButtonText: 'Додати всі',
                    removeAllButtonText: 'Видалити всі',

                });
            };

            return {
                init: function () {
                    demo1();
                },
            };
        }();

        window.addEventListener('load', function () {
            KTDualListbox.init();
        });
    }

    function loadMenuCategory() {
        let id = $(this).data('id');
        let lang = $('meta[name="lang"]').attr('content');
        var leftList = $('#kt_dual_listbox_1');
        $.ajax({
            url: '/' + lang + '/admin/menu/category/show',
            data: {
                'id': id
            },
            success: function (response) {

                let menu = response.menu;
                let html = response.html;

                $('#subcategories').html('');
                $('#subcategories').append(html).promise().done(function () {
                    var _this = document.getElementById('some1');

                    var dualListBox = new DualListbox(_this, {
                        addEvent: function (value) {
                            console.log(value);
                        },
                        removeEvent: function (value) {
                            console.log(value);
                        },
                        availableTitle: 'Категорії',
                        selectedTitle: 'Підкатегорії',
                        addButtonText: 'Додаим',
                        removeButtonText: 'Видалити',
                        addAllButtonText: 'Додати всі',
                        removeAllButtonText: 'Видалити всі',
                    });
                });

                $('.menuId').val(id);
                $('.menuCategoryId').find('option[value="' + menu.category_id + '"]').attr("selected", "selected");
                $('.menuStatus').find('option[value="' + menu.status + '"]').attr("selected", "selected");


                $('.selectpicker').selectpicker('refresh');
                $('#updateMenuCategoryModal').modal('show');

            }, error: function (response) {
                console.log(response)
            }
        });
    }


    $(document).on('click', '.updateMenuCategory', loadMenuCategory);


    /* Menu */
    jQuery(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        KTSummernoteDemo.init();

        let lang = $('meta[name="lang"]').attr('content');
        let tbody = document.querySelector('#table_menu')
        new Sortable(tbody, {
            animation: 150,
            handle: '.menu_item_handle',
            dragClass: 'table-sortable-drag',
            onEnd: function (evt) {
                var list = [];
                $.each($('#table_menu tr'), function (idx, el) {
                    list.push({
                        id: $(el).data('id'),
                        pos: idx + 1
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '/' + lang + '/admin/menu/update-positions',
                    data: {
                        positions: list,
                    },
                    success: function (response) {
                        console.log(response)
                    }
                });

            }
        });
        let footer_tbody = document.querySelector('#footer_table_menu')
        new Sortable(footer_tbody, {
            animation: 150,
            handle: '.menu_item_handle',
            dragClass: 'table-sortable-drag',
            onEnd: function (evt) {
                var list = [];
                $.each($(footer_tbody).find('tr'), function (idx, el) {
                    list.push({
                        id: $(el).data('id'),
                        pos: idx + 1
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '/' + lang + '/admin/menu/update-positions',
                    data: {
                        positions: list,
                    },
                    success: function (response) {
                        console.log(response)
                    }
                });

            }
        });
    });




    $(document).on('click', '.updateMenuHeader', loadMenuHeader);

    function loadMenuHeader()
    {
        let id = $(this).data('id');
        let lang = $('meta[name="lang"]').attr('content');

        $.ajax({
            url: '/' + lang + '/admin/menu/show',
            data: {
                'id': id
            },
            success: function (response) {
                let menu_item = response.menu_item;

                $('#menuInputId').val(menu_item.id);
                $('#menuInputTitle').val(menu_item.title);
                $('#menuInputUrl').val(menu_item.url);
                $('#menuInputType').find('option[value="' + menu_item.type + '"]').attr("selected", "selected");
                $('#menuInputStatus').find('option[value="' + menu_item.status + '"]').attr("selected", "selected");
                $('#menuInputPosition').val(menu_item.position);

            }, error: function (response) {
                console.log(response)
            }
        });
    }

});
