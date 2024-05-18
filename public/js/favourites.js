$(document).ready(function () {
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
// Add to favourites
    $('.product_favourite').on('click', function () {
        let id = this.getAttribute('data-value');

        if (this.classList.contains('active')) {
            removeFromFavourite(id, this);
        } else {
            addToFavourite(id, this);
        }
    })
});

function addToFavourite(id, button) {
    const heart = document.getElementById('header__linkcount'),
        heart_sm = document.getElementById('mobile__linkcount');

    $.ajax({
        url: '/favourites',
        method: 'POST',
        data: {
            id: id
        },
        success: function (response) {
            button.classList.add('active');
            throwMessage(response.message);
            updateTotalFavouriteCount(response.total_count);
        }
    })
}

function removeFromFavourite(id, button) {
    const heart = document.getElementById('header__linkcount'),
        heart_sm = document.getElementById('mobile__linkcount');

    $.ajax({
        url: '/favourites',
        method: 'DELETE',
        data: {
            id: id
        },
        success: function (response) {
            button.classList.remove('active');
            throwMessage(response.message);
            updateTotalFavouriteCount(response.total_count);
        }
    })
}

function updateTotalFavouriteCount(count) {
    let heart = document.getElementById('header__linkcount');
    let heart_sm = document.getElementById('mobile__linkcount');

    if (count > 0) {
        heart.classList.remove('hidden');
        heart.innerText = count;
        heart_sm.classList.remove('hidden');
        heart_sm.innerText = count;
    }
    else {
        heart.classList.add('hidden');
        heart_sm.classList.add('hidden');
    }
}
