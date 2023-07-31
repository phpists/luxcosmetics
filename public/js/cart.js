$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.addToCart', function (e) {
        e.preventDefault()

        let product_id = $(this).data('product'),
            $this = $(this);

        if (!product_id)
            return

        if ($this.hasClass('isInCart')) {
            removeFromCart(product_id, $this)
        } else {
            addToCart(product_id, $this)
        }
    })

    $(document).on('click', '.removeFromCart', function (e) {
        e.preventDefault();

        let product_id = $(this).data('product'),
            $this = $(this);

        if (!product_id)
            return

        removeFromCart(product_id, $this)
    })

    $(document).on('click', '.plusQuantity', function (e) {
        e.preventDefault()

        let $item = $(this).parents($(this).data('element'))

        if ($item) {
            let product_id = $item.data('product');
            plusQuantity(product_id, $(this))
        }
    })

    $(document).on('click', '.minusQuantity', function (e) {
        e.preventDefault()

        let $item = $(this).parents($(this).data('element'))

        if ($item) {
            let product_id = $item.data('product');

            minusQuantity(product_id, $(this))
        }
    })


    $(document).on('click', '#addproduct .close', function (e) {
        $.magnificPopup.close({
            items: {
                src: '#addproduct'
            }
        });
    })

    $(document).on('click', '.changeModification', changeModification)


    $(document).on('click', '.toggle-address', function (e) {
        $(this).next().fadeToggle()
        $('input[name="address_id"]').prop('checked', false)
    })

    $(document).on('click', '.toggle-card', function (e) {
        $(this).next().fadeToggle()
        $('input[name="card_id"]').prop('checked', false)
    })

    $(document).on('submit', '#orderForm', function (e) {
        let data = $(this).serializeArray(),
            $this = $(this)

        if (findValueByName('address_id', data) === null) {
            let $submitAddressButton = $('#createAddressForm').find('button[type="submit"]')
            if (!$submitAddressButton.is(':focusable'))
                $submitAddressButton.parents('div.toggable').fadeIn();

            if (!validateForm($('#createAddressForm'))) {
                e.preventDefault()
                $submitAddressButton.click()
            } else {
                let additionalData = $('#createAddressForm').serializeArray();

                additionalData.forEach(function (item, i) {
                    if (item.name === '_token')
                        return

                    $('<input>').attr({
                        type: 'hidden',
                        name: `address[${item.name}]`,
                        value: item.value
                    }).appendTo($this);
                })
            }
        }
    })


    $(document).on('submit', '#checkoutForm', function (e) {
        let data = $(this).serializeArray(),
            $this = $(this)

        if (findValueByName('card_id', data) === null) {
            let $submitAddressButton = $('#createCardForm').find('button[type="submit"]')
            if (!$submitAddressButton.is(':focusable'))
                $submitAddressButton.parents('div.toggable').fadeIn();

            if (!validateForm($('#createCardForm'))) {
                e.preventDefault()
                $submitAddressButton.click()
            } else {
                let additionalData = $('#createCardForm').serializeArray();

                additionalData.forEach(function (item, i) {
                    if (item.name === '_token')
                        return

                    $('<input>').attr({
                        type: 'hidden',
                        name: `card[${item.name}]`,
                        value: item.value
                    }).appendTo($this);
                })
            }
        }
    })


})



function validateForm(form) {
    let isEmpty = false;
    $(form).find('input[required]').each(function() {
        if ($(this).val() === '' || $(this).val() === undefined) {
            isEmpty = true;
            return false; // Зупинити цикл, якщо знайдено порожнє поле
        }
    });

    return !isEmpty;
}


function addToCart(product_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/add',
        dataType: 'json',
        data: {
            product_id: product_id
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
                $('#addproduct').find('div.addprod').html(response.product_html)
                $.magnificPopup.open({
                    items: {
                        src: '#addproduct',
                        type: 'inline',
                        modal: true
                    }
                });
                $('.minus').unbind('click');
                $('.plus').unbind('click');
                $('.minus').click(function () {
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    $input.val(count);
                    $input.change();
                    return false;
                });
                $('.plus').click(function () {
                    var $input = $(this).parent().find('input');
                    $input.val(parseInt($input.val()) + 1);
                    $input.change();
                    return false;
                });
            }
        }
    })
}

function removeFromCart(product_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/remove',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.removeClass('isInCart')
                updateTotalSum(response.total_sum)

                if ($button.data('element') !== undefined) {
                    let selector = $button.data('element')
                    $($button).parents(`${selector}`).remove()
                }

                if (location.pathname === '/cart') {
                    if ($('#cartProductsContainer div.cart-product').length < 1)
                        location.reload()
                }
            }
        }
    })
}

function plusQuantity(product_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/plus-quantity',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        beforeSend: function () {
            $button.prop('disabled', true)
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
                $button.parents($button.data('element')).find('.currentQuantity').val(response.quantity)
                $button.parents('div.cart-product:first').find('.currentSum').text(response.sum)
                updateTotalSum(response.total_sum)
                $('#modalCurrentProductSum').text(response.sum)
            }
        },
        complete: function () {
            $button.prop('disabled', false)
        }
    })
}

function minusQuantity(product_id, $button) {
    $.ajax({
        type: 'post',
        url: '/cart/minus-quantity',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        beforeSend: function () {
            $button.prop('disabled', true)
        },
        success: function (response) {
            if (response) {
                updateTotalCount(response.total_count)
                $button.addClass('isInCart')
                $button.parents($button.data('element')).find('.currentQuantity').val(response.quantity)
                $button.parents('div.cart-product:first').find('.currentSum').text(response.sum)
                updateTotalSum(response.total_sum)
                $('#modalCurrentProductSum').text(response.sum)
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


function changeModification(e) {
    let $this = $(this),
        url = $(this).data('url')

    $.ajax({
        url: url,
        dataType: 'json',
        success: function (response) {
            if (response) {
                $this.parents('div.product').after(response.html).remove()
            }
        }
    })
}

function updateTotalSum(sum) {
    $('#totalSum').text(sum)
    let min_sum = $('#min_sum').val();

    if (min_sum) {
        if (min_sum <= sum) {
            $('#submitButton').prop('disabled', false)
        } else {
            $('#submitButton').prop('disabled', true)
        }
    } else {
        $('#submitButton').prop('disabled', false)
    }
}

function findValueByName(name, serializedForm) {
    for (let i = 0; i < serializedForm.length; i++) {
        if (serializedForm[i].name === name)
            return serializedForm[i].value;
    }
    return null;
}
