function numberSelected() {

    var data = $('#product_questions_form').serializeArray();

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
        url = $('#filterUrl').data('url') + '?' + $('#product_questions_form').serialize();
    }
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (response) {
            $('#table-container').html(response.tableHtml);
            $('#pagination').html(response.paginateHtml);
            addStatusChange()
            $('.selectpicker').selectpicker();
            window.history.pushState(null, null, url);
        }
    });

}
function addStatusChange() {
    let csrf = $('meta[name="csrf-token"]').attr('content');
    document.querySelectorAll('.status_select').forEach(function (el, idx) {
        el.addEventListener('change', function (ev) {
            let data = {
                id: ev.currentTarget.getAttribute('data-id'),
                status: ev.currentTarget.value,
                csrf: csrf
            }
            $.ajax({
                url: '/admin/product_question/update_status',
                method: 'POST',
                data: data
            })
        })
    })
}
$(document).ready(function () {
    addStatusChange();
    $('.edit_question').each(function (idx, el) {
        el.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            $.ajax({
                url: '/admin/product_questions/' + id,
                data: {
                    id: id
                },
                success: function (resp) {
                    $('#updateQuestionMessage').val(resp.message);
                    $(`#updateStatus option[value="${resp.status}"]`).attr('selected', true);
                    $('#question_id').val(resp.id);
                }
            })
        })
    })
    $(document).on('change', '#chats_form', function (e) {
        e.preventDefault();
        request();
    });
    $(document).on('change', '#feedbacks_reason_id', function (e) {
        e.preventDefault();
        request();
    });
    $(document).on('change', '#status_filter', function (e) {
        e.preventDefault();
        request();
    });
    $(document).on('click', '.deactivateChat', function (e) {

        let status = $(this).data('status');
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let checkbox = $(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});

        $.ajax({
            type: "POST",
            url: '/admin/product_question/update_bulk_status',
            data: {
                csrf: csrf,
                checkbox: checkbox,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                let title = response.title;
                let message = response.message;

                checkbox.forEach(function (id) {
                    $('#category_' + id).find('.status_select').val("3").change();
                });
                toastr.success(message);
            }
        });
    });
});
