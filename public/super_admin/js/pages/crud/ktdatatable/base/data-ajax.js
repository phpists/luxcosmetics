"use strict";
// Class definition

var KTDatatableRemoteAjaxDemo = function () {
    // Private functions

    // basic demo
    var demo = function () {

        let lang = $('meta[name="lang"]').attr('content');
        var csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/' + lang + '/admin/products',

                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: true,
                textAlign: 'center',
            }, {
                field: 'title',
                title: 'Название',
            }, {
                field: 'code',
                title: 'Код',
            }, {
                field: 'title',
                title: 'Категория',
            }, {
                field: 'price',
                title: 'Цена',
            }, {
                field: 'image',
                title: 'Изображение',
            }, {
                field: 'created_at',
                title: 'Редактировано',
            }, {
                field: 'status',
                title: 'Статус',
            }, {
                field: 'Actions',
                title: 'Действие',
                sortable: false,
                width: 125,
                overflow: 'visible',
                autoHide: false,
                template: function () {

                },
            }],

        });

    };

    return {
        // public functions
        init: function () {
            demo();
        },
    };
}();

jQuery(document).ready(function () {
    KTDatatableRemoteAjaxDemo.init();
});
