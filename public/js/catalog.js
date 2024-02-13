document.addEventListener('DOMContentLoaded', function () {
    window.onload = () => {
        let filterForm = document.getElementById("filterForm");
        filterForm.style.visibility = 'visible';
        filterForm.classList.add('show');
    }
});
function initFilters() {
    // document.getElementById('btn_show_selected')?.addEventListener('click', (ev) => {
    //     ev.preventDefault();
    //     $("#filters").removeClass("is-active");
    //     $(".filters-overlay").removeClass("is-active");
    // });

    $(".btnfilters").click(function () {
        $("#filters").addClass("is-active");
        $(".filters-overlay").addClass("is-active");
    });

    $(".filters-overlay").click(function () {
        $(this).removeClass("is-active");
        $("#filters").removeClass("is-active");
        $(".sortmobile").removeClass("is-active");
    });

    $(".filters__close").click(function () {
        $(".filters-overlay").removeClass("is-active");
        $("#filters").removeClass("is-active");
    });

    $(".btnsort").click(function () {
        $(".sortmobile").addClass("is-active");
        $(".filters-overlay").addClass("is-active");
    });
    $(".sortmobile__close").click(function () {
        $(".filters-overlay").removeClass("is-active");
        $(".sortmobile").removeClass("is-active");
    });
}
$(document).ready(function () {
    // let tagHidden = document.querySelectorAll('.seoblock__tag.is-hidden');
    //
    // $(".seoblock__moretags").click(function() {
    //     $(this).text(function(i, text){
    //         return text === "Свернуть" ? "Развернуть" : "Свернуть";
    //     })
    //     for (let i = 0; i < tagHidden.length; i++) {
    //         tagHidden[i].classList.toggle("is-hidden");
    //     }
    // });
    document.getElementById('btn_show_selected')?.addEventListener('click', (ev) => {
        ev.preventDefault();
        $("#filters").removeClass("is-active");
        $(".filters-overlay").removeClass("is-active");
    })
    $(document).on('click', '.pagination__more', function () {
        let is_disabled = $('.pagination__item--next').attr('aria-disabled')
        if(is_disabled === 'false') {
            let url = this.dataset.url
            $.ajax({
                url: url,
                data: {
                    load_more: true
                },
                success: function (response) {
                    $('#catalog div.category-page__products').append(response.products)
                    $('#catalog div.category-page__pagination').remove()
                    $('#catalog').append(response.pagination)
                    let currentlyShowedCount = parseInt($('#currentlyShowedCount').text());
                    $('#currentlyShowedCount').text(currentlyShowedCount + response.new_count)
                },
                error: function (response) {
                    console.log(response)
                }
            })
        }
    })

    $(document).on('click', '.pagination__item', function(e) {
        e.preventDefault();
        let url = $(this).find('a').attr('href');

        if (url !== '#') {
            $.ajax({
                url: url,
                data: {
                    change_page: true
                },
                beforeSend: function () {
                    $('#catalog').addClass('loading')
                },
                success: function (response) {
                    $('#catalog').html(response.html)
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                },
                error: function (response) {
                    console.log(response)
                },
                complete: function () {
                    $('#catalog').removeClass('loading')
                }
            })
        }

        return false
    })

    $(document).on('change', '#select_sort_preview', function(e) {
        $('#filterForm input[name="sort"]').val(this.value)
        $('#filterForm').trigger('change')
    })

    $(document).on('slidechange', '#slider-range', function(e) {
        $('#filterForm').trigger('change')
    })
    $(document).on('change', '#amount', function(e) {
        $('#filterForm').trigger('change')
        $('#slider-range').slider( "values", 0, this.value);
    })
    $(document).on('change', '#amount2', function(e) {
        $('#filterForm').trigger('change')
        $('#slider-range').slider( "values", 1, this.value);
    })

    $(document).on('change', '#filterForm', function(e) {
        let data = $(this).serializeArray();
        data.push({
            name: "load", value: true
        });

        const uri_data = new FormData(this);
        const queryString = new URLSearchParams(uri_data).toString();

        let uri = location.pathname + '?' + queryString

        $.ajax({
            type: 'GET',
            data: data,
            beforeSend: function () {
                $('#catalog').addClass('loading')
            },
            success: function (response) {
                $('#catalog').html(response.html)
                $('#filterPropertyCounts').val(JSON.stringify(response.filterCounts))
                initFilters();
                updateFilter();
            },
            complete: function () {
                $('#catalog').removeClass('loading')
                history.replaceState(null, null, uri)
            }
        })
    })

    $(document).on('submit', '#filterForm', function(e) {
        e.preventDefault()
        $(this).trigger('change')
        return false
    })


    updateFilter()
})


function updateFilter() {
    let counts = JSON.parse($('#filterPropertyCounts').val());

    for (let property_id in counts) {
        let $property = $(`.filters__item[data-property="${property_id}"]:not(:has(input:checked))`);
        $property.find('label').each(function (i, property_value) {
            let $input = $(property_value).find('input'),
                property_value_id = $input.val()

            if (counts[property_id][property_value_id] > 0) {
                $(property_value).removeClass('disabled');
                $input.prop('disabled', false);
            } else {
                $(property_value).addClass('disabled');
                $input.prop('disabled', true)
            }
        })
        // let maxCount = Math.max(...Object.values(counts[property_id]))
        // if (maxCount < 1) {
        //     $property.hide()
        // } else {
        //     $property.show()
        // }

        if ($property.find('label').filter(function() {
            return $(this).css('display') !== 'none';
        }).length > 3) {
            $property.find('button.filter__all').show()
        } else {
            $property.find('button.filter__all').hide()
        }
    }
}
