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
        let action = this.getAttribute('data-label')  === '1'? 'DELETE': 'POST';
        let new_action = this.getAttribute('data-label')  === '1'? '0': '1';
        let el = this;
        if(id !== null) {
            $.ajax({
                url: '/favourites',
                method: action,
                data: {
                    id: id
                },
                success: function (response) {
                    el.setAttribute('data-label', new_action);
                }
            })
        }
    })
});
