$(document).ready(function () {
    $(document).on('click', '.editBestSellerBtn', function () {
        var id = $(this).data('id');
        var csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "GET",
            url: '/admin/best-seller/show',
            dataType: "json",
            data: {
                id: id,
                csrf: csrf,
            },
            success: function (response) {
                var item = response.item;
                var route = response.route;

                $('#bestSellersForm').attr('action', route);
                $('#bestSellersId').val(item.id);
                $('#bestSellersTitle').val(item.title);
                $('#bestSellersDescription').val(item.description);
                $('#bestSellersLink').val(item.link);
                $('#bestSellersImage').css('background-image', 'url(' + item.image + ')');
            }
        });
    });
});
