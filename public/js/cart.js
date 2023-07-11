$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.addToCart', function (e) {
        e.preventDefault()

        let product_id = $(this).data('product'),
            property_id = $(this).data('property'),
            $this = $(this);

        if (!product_id || !property_id)
            return

        if ($this.hasClass('isInCart')) {
            removeFromCart(product_id, property_id, $this)
        } else {
            addToCart(product_id, property_id, $this)
        }
    })

    $(document).on('click', '.removeFromCart', function (e) {
        e.preventDefault();

        let product_id = $(this).data('product'),
            property_id = $(this).data('property'),
            $this = $(this);

        if (!product_id || !property_id)
            return

        removeFromCart(product_id, property_id, $this)
    })

    $(document).on('click', '.plusQuantity', function (e) {
        e.preventDefault()

        let $item = $(this).parents($(this).data('element'))

        if ($item) {
            let product_id = $item.data('product'),
                property_id = $item.data('property');

            plusQuantity(product_id, property_id, $(this))
        }
    })

    $(document).on('click', '.minusQuantity', function (e) {
        e.preventDefault()

        let $item = $(this).parents($(this).data('element'))

        if ($item) {
            let product_id = $item.data('product'),
                property_id = $item.data('property');

            minusQuantity(product_id, property_id, $(this))
        }
    })

})


function addToCart(product_id, property_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/add',
        dataType: 'json',
        data: {
            product_id: product_id,
            property_id: property_id
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
            }
        }
    })
}

function removeFromCart(product_id, property_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/remove',
        dataType: 'json',
        data: {
            product_id: product_id,
            property_id: property_id
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.removeClass('isInCart')
                $('#totalSum').text(response.total_sum)

                if ($button.data('element') !== undefined) {
                    let selector = $button.data('element')
                    $($button).parents(`${selector}`).remove()
                }
            }
        }
    })
}

function plusQuantity(product_id, property_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/plus-quantity',
        dataType: 'json',
        data: {
            product_id: product_id,
            property_id: property_id
        },
        beforeSend: function () {
            $button.prop('disabled', true)
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
                $button.parents($button.data('element')).find('.currentQuantity').val(response.quantity)
                $('#totalSum').text(response.total_sum)
            }
        },
        complete: function () {
            $button.prop('disabled', false)
        }
    })
}

function minusQuantity(product_id, property_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/minus-quantity',
        dataType: 'json',
        data: {
            product_id: product_id,
            property_id: property_id
        },
        beforeSend: function () {
            $button.prop('disabled', true)
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
                $button.parents($button.data('element')).find('.currentQuantity').val(response.quantity)
                $('#totalSum').text(response.total_sum)
            }
        },
        complete: function () {
            $button.prop('disabled', false)
        }
    })
}

function updateTotalCount(count) {
    $('#cartTotalCount').text(count)
}
