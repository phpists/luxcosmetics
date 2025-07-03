$(document).ready(function () {
    $(document).on('click', '.editMainSliderBtn', function () {
        var id = $(this).data('id');
        var csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "GET",
            url: '/admin/main-slider/show',
            dataType: "json",
            data: {
                id: id,
                csrf: csrf,
            },
            success: function (response) {
                var item = response.item;
                var route = response.route;

                $('#homeSliderForm').attr('action', route);

                $('#homeSliderId').val(item.id);
                $('#homeSliderTitle').val(item.title);
                $('#homeSliderDescription').val(item.description);
                $('#homeSliderLink').val(item.link);
                $('#homeSliderBtnTitle').val(item.btn_title);
                $('#homeSliderImage').css('background-image', 'url(' + item.image + ')');
            }
        });
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let tbody = document.querySelector('tbody')
        new Sortable(tbody, {
            animation: 150,
            handle: '.handle',
            dragClass: 'table-sortable-drag',
            onEnd: function (/**Event*/ evt) {
                var list = [];
                $.each($('tbody.brand-table tr'), function (idx, el) {
                    list.push({
                        id: $(el).data('id'),
                        cat_id: $(el).data('label'),
                        position: idx + 1
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '',
                    data: {
                        positions: list,
                    },
                    success: function (response) {
                        $.each(response, function (i, item) {
                            let id = item['id'];
                            let position = item['position'];
                            $(`tr[data-id="${id}"]`).find('.position').text(position)
                        })
                    }
                });
            }
        });
    });
});
