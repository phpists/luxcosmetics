const refreshUrl = $('#refreshOrderProductsTableUrl').val();

$(function () {
    $('select.select2').select2();

    $(document).on('submit', '#orderAddProductForm', function (e) {
        e.preventDefault();
        let $this = $(this),
            data = $this.serializeArray();

        let productsData = getProductsData()
        data = data.concat(productsData);

        updateTable(data, $('#orderAddProductForm').attr('action'))
    })

    $(document).on('change', '.productsTableQuantity', function (e) {
        updateTable(getProductsData())
    })

    $(document).on('click', '.removeProduct', function (e) {
        let url = $(this).data('url'),
            exists = $(this).data('exists') !== undefined,
            $row = $(this).parents($(this).data('row'));

        Swal.fire({
            title: "Вы уверены?",
            text: "Это действие нельзя отменить!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Да, удалить!",
            cancelButtonText: "Нет, отмена!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                if (exists) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        dataType: 'json',
                        success: function (response) {
                            if (response.result) {
                                $row.remove()
                                Swal.fire(
                                    "Удалено!",
                                    "Продукт удалён",
                                    "success"
                                )
                                updateTable(getProductsData())
                            }
                        }
                    })
                } else {
                    $row.remove()
                    Swal.fire(
                        "Удалено!",
                        "Продукт удалён",
                        "success"
                    )
                    updateTable(getProductsData())
                }
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Отменено",
                    "Действие отменено",
                    "error"
                )
            }
        });
    })


    $(document).pjax('[data-pjax]', '#gifts')

})


function getProductsData() {
    let formData = $('#orderForm').serializeArray();

    let productsData = [];
    formData.forEach(function (item, i) {
        if (item.name.includes('products'))
            productsData.push(item)
    })

    return productsData
}

function updateTable(data, url = refreshUrl) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success: function (response) {
            if (response.result) {
                $('#orderProductsTable tbody').html(response.html)
                $('#addProduct').modal('hide')
            }
            filterGifts()
        }
    })
}

function filterGifts() {
    let products = $('#orderForm').serializeArray().filter(function(item) {
        return item.name.startsWith('products[');
    });
    $.pjax.reload({
        type: 'POST',
        url: $('#giftsUrl').val(),
        push: false,
        replace: false,
        container: '#gifts',
        data: products,
    })
}
