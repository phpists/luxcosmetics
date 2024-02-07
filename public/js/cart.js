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
        console.log('test')
        e.preventDefault()

        let $item = $(this).parents($(this).data('element'))

        let max_amount = parseInt(e.currentTarget.dataset.end);

        let current_amount = parseInt(this.parentElement.querySelector('.currentQuantity').value);

        if ($item && (max_amount > current_amount)) {
            let product_id = $item.data('product');
            plusQuantity(product_id, $(this))
        } else if($item && (max_amount <= current_amount)) {
            toastr.warning(`Нельзя заказать больше чем ${max_amount}`)
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
        let $form = $(this),
            data = $(this).serializeArray();

        if ($form.find('input[name="address_id"]')) {
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
                        }).appendTo($form);
                    })
                }
            }
        }

        if ($form.find('input[name="card_id"]')) {
            console.log(data)
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
                        }).appendTo($form);
                    })
                }
            }
        }
    })


    // Price Filter Slider Init
    let minFilterPrice = Math.floor($('#filterMinPrice').val());
    let minCurrentPrice = Math.floor($('#filterCurrentMinPrice').val())
    let maxFilterPrice = Math.ceil($('#filterMaxPrice').val());
    let maxCurrentPrice = Math.floor($('#filterCurrentMaxPrice').val())

    $("#slider-range").slider({
        range: true,
        min: minFilterPrice,
        max: maxFilterPrice,
        values: [minCurrentPrice, maxCurrentPrice],
        slide: function (event, ui) {
            $("#filterCurrentMinPrice").val(ui.values[0]);
            $("#filterCurrentMaxPrice").val(ui.values[1]);
        }
    });

    $("#amount").val($("#slider-range").slider("values", 0));
    $("#amount2").val($("#slider-range").slider("values", 1));





    // Data mirroring
    $(document).on('input', "input[data-mirror]", function (e) {
        $(this.dataset.mirror).val(this.value)
    })
    $(document).on('change', "input[data-mirror]", function (e) {
        $(this.dataset.mirror).val(this.value)
    })


})



function validateForm(form) {
    let isValid = true;
    $(form).find('input[required]').each(function() {
        console.log($(this).attr('type'))

        if ($(this).attr('type') === 'radio') {

            if ($(`input[name=${$(this).attr('name')}:checked`).length < 1) {
                isValid = false;
                return false; // Зупинити цикл, якщо знайдено порожнє поле
            }
        } else {
            if ($(this).val() === '' || $(this).val() === undefined) {
                isValid = false;
                return false; // Зупинити цикл, якщо знайдено порожнє поле
            }
        }
    });

    return isValid;
}


function addToCart(product_id, $button) {
    $button.addClass('isLoading').prop('disabled', true)
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
    }).done(function () {
        $button.removeClass('isLoading').prop('disabled', false)
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
                // updateTotalSum(response.total_sum)
                updateTotalBlock(response.total_block)

                if ($button.data('element') !== undefined) {
                    let selector = $button.data('element')
                    $($button).parents(`${selector}`).remove()
                }

                if (location.pathname === '/cart') {
                    if ($('#cartProductsContainer div.cart-product').length < 1)
                        location.reload()
                }

                if (response.can_checkout)
                    allowCheckout()
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
                // updateTotalSum(response.total_sum)
                updateTotalBlock(response.total_block)
                $('#modalCurrentProductSum').text(response.sum)

                if (!response.can_checkout)
                    disableCheckout(response.can_not_checkout_message)
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
                // updateTotalSum(response.total_sum)
                updateTotalBlock(response.total_block)
                $('#modalCurrentProductSum').text(response.sum)

                if (response.can_checkout)
                    allowCheckout()
            }
        },
        complete: function () {
            $button.prop('disabled', false)
        }
    })
}

function updateTotalCount(count) {
    $('.cart_small_link_count').text(count)
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

function updateTotalBlock(html) {
    $('#cartTotalBlock').html(html)
    loadGifts()
}

function findValueByName(name, serializedForm) {
    for (let i = 0; i < serializedForm.length; i++) {
        if (serializedForm[i].name === name)
            return serializedForm[i].value;
    }
    return null;
}

function allowCheckout() {
    $('button.cartSubmit').prop('disabled', false)
    $('.cart-aside > .formerror').remove()
}

function disableCheckout(message) {
    $('button.cartSubmit').prop('disabled', true)
    if ($('.cart-aside > .formerror').length < 1) {
        $('button.cartSubmit').before(`<div class="formerror">${message}</div>`)
    }
}

function loadGifts() {
    if ($('#giftsContainer').length > 0)
        $('#giftsContainer').load($('#giftsUrl').val())
}
