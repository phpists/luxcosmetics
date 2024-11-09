const SUGGEST_API_KEY = '05c41b12-223c-47e0-a0df-9403b108f3cd';
const SEARCH_API_KEY = 'd46bfdd1-d9ca-4f94-959e-5c09d2a427e1';
const ADDRESS_OUTPUT_ID = 'final_addr';
const PICKUP_DELIVERY = 'pickup';
const COURIER_DELIVERY = 'courier';
const WINDOW_SM_SIZE = 980;
var myMap;









$(function () {
    let address_state = document.getElementById('delivery_state').value,
        address_city = document.getElementById('delivery_city').value;


    if (typeof ymaps === 'undefined')
        alert('Не удалось подключить Яндекс.Карты, пожалуйста, попробуйте перезагрузить страницу')
    else {
        ymaps.ready(initYandex).then(() => {
            if (address_city) {
                let address_state_city = address_state ? address_state + ', ' + address_city : address_city;

                setTimeout(() => {
                    initMapItems(address_city)
                }, 1000)

                locationItemClickHandler(address_state_city, address_city, address_state)
            }

            let $checkedDeliveryInput = $('[name="delivery"][checked]');
            if ($checkedDeliveryInput.length > 0) {
                $checkedDeliveryInput.prop('checked', true);

                if ($checkedDeliveryInput.val() == PICKUP_DELIVERY) {
                    let pickup_addr = document.getElementById('pickup_addr');
                    pickup_addr.innerText = document.getElementById(ADDRESS_OUTPUT_ID).value;
                    showCartTab('pickup_delivery_tab');
                } else if ($checkedDeliveryInput.val() == COURIER_DELIVERY) {
                    document.getElementById('courier_addr').innerText = document.getElementById(ADDRESS_OUTPUT_ID).value;

                    showCartTab('coruier_tab');
                }
            }
        });
    }
})










function initYandex(){
    // Creating the map.
    myMap = new ymaps.Map("map", {
        // The map center coordinates.
        // Default order: «latitude, longitude».
        // To not manually determine the map center coordinates,
        // use the Coordinate detection tool.
        center: [55.76, 37.64],
        // Zoom level. Acceptable values:
        // from 0 (the entire world) to 19.
        zoom: 7
    });
}

function isSmallSize() {
    return window.innerWidth <= WINDOW_SM_SIZE;
}

const handleRenderOrderModal = (title, address, id, street, house) => {

    const modal = document.querySelector(".overlay-order");
    const content = `
      <div class="modal_maps">
          <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
              class="closeBtn"
          >
              <path d="M2 2L18 18" fill="none" stroke-width="1.5"></path>
              <path d="M2 18L18 2" fill="none" stroke-width="1.5"></path>
          </svg>
          <div class="pickup-item__title">${title ?? ""}</div>
          <div class="pickup-item__address">
              <div class="pickup-item__text"> ${address ?? ""}</div>
          </div>
          <button data-address="${address ?? ''}" data-street="${street}" data-house="${house}" data-post_name="${title?? ''}" class="submit submit_address">Привезти сюда</button>
      </div>
    `;

    modal.innerHTML = "";
    modal.innerHTML = content;
    const closeBtn = document.querySelector(".overlay-order .closeBtn");
    modal.classList.add("active");
    const submitBtn = document.querySelector(".submit_address");
    closeBtn.addEventListener("click", () => modal.classList.remove("active"));
    submitBtn.addEventListener('click', (ev) => {
        handleSubmitDeliveryAddress(ev, id);
        modal.classList.remove("active");
    });
};


const handleToggleLoading = (type = true) => {
    const loader = document.querySelector(".overlay-loading");
    loader.classList.toggle("active", type);
};

const handleOrder = () => {
    const buttons = document.querySelectorAll(".pickup-item__button");

    buttons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            const title = btn.getAttribute("data-title");
            const address = btn.getAttribute("data-address");
            const street = btn.getAttribute("data-street");
            const house = btn.getAttribute("data-house");

            handleRenderOrderModal(title, address, id, street, house);
        });
    });
};

const handleSelectPost = (id) => {
    const pickupCards = document.querySelectorAll(".pickup-item");
    const listWrapper = document.querySelector(".pick-up-points");

    pickupCards.forEach((card) => {
        const cardId = card.getAttribute("data-id");
        card.classList.toggle("active", cardId === id);
        if (cardId === id) {
            listWrapper.scroll({
                top: card?.offsetTop - 200,
                behavior: "smooth",
            });
        }
    });
};

const handleClickOnPickItem = () => {
    const pickupCards = document.querySelectorAll(".pickup-item");

    pickupCards.forEach((card) => {
        const cardId = card.getAttribute("data-id");
        card.addEventListener("click", () => handleSelectPost(cardId));
    });
};

function searchInit() {
    const input = document.querySelector(".find-address-input");
    input.addEventListener('input', handleSearch);
}

const handleOfficeZoom = () => {
    document.querySelectorAll('.pickup-item').forEach((el) => {
        el.addEventListener('click', () => {
            let center = el.dataset.value.split(',');
            myMap.setCenter(center, 15, {
                duration: 500
            });
        })
    })
}

const handleFormatPickupCard = (place) => {
    let house = place.fullAddress.split(',').pop(),
        street = '';

    place.fullAddress.split(',').forEach((addressPart) => {
        if (addressPart.toLowerCase().includes('ул.') || addressPart.toLowerCase().includes('улица'))
            street = addressPart;
    })

    return `
    <div class="pick-up-point pickup-item" data-id="${place.id}" data-value="${place.gpsCoordinates}">
        <div class="pick-up-point__title">${place.deliveryMethodTitle + ' №' + place.pointId}</div>
        <div class="pick-up-point__content">
            <p>${place.name}</p>
            <p>${place.fullAddress}</p>
<!--            <p>стоимость — <b>бесплатно</b></p>-->
<!--            <p>дата доставки — <b>сегодня, 3 октября</b></p>-->
<!--            <p>нет оплаты при получении</p>-->
            <div class="pick-up-point__ftr">
                <p><small>Режим работы</small> ${place.openingHoursText}</p>
<!--                <p><small>Контактный телефон</small> 8 800 770 70 21</p>-->
            </div>
        </div>
        <button class="btn btn--accent pickup-item__button" data-id="${place.id}" data-title="${place.deliveryMethodTitle}" data-street="${street}" data-house="${house}" data-address="${place.shortAddress}">Привезти сюда</button>
    </div>
`
};

function handleClickBaloon(post_office_id) {
    const listWrapper = document.querySelector(".pick-up-points");

    document.querySelector('.pickup-item.active')?.classList.toggle('active');
    let selectedBaloon = document.querySelector(`.pickup-item[data-id='${post_office_id}']`);

    selectedBaloon?.classList.toggle('active')

    listWrapper.scroll({
        top: selectedBaloon?.offsetTop - 200,
        behavior: "smooth",
    });

    // if (isSmallSize()) {
        let pickupBtn = selectedBaloon.querySelector('.pickup-item__button');
        handleRenderOrderModal(pickupBtn.dataset.title, pickupBtn.dataset.address, post_office_id, pickupBtn.dataset.street, pickupBtn.dataset.house);
    // }
}

function setMarker(item){
    let myGeoObject = new ymaps.Placemark(
        [...item.gpsCoordinates.split(',')],
        {
            balloonContent: `<h2>${item.deliveryMethodTitle} №${item.pointId}</h2>`
                + `<h3>${item.name}</h3><h4>${item.fullAddress}</h4><p>${item.openingHoursText}</p>`
        },
        {
            preset: 'islands#icon',
            iconColor:'#0095b6'
        }
    );
    myGeoObject.events.add('click', () => {
        handleClickBaloon(item.id);
    })
    myMap.geoObjects.add(myGeoObject);
}

function displayPlaces(places, clearArea) {
    let cards = places.data.map((item) => {
        setMarker(item);
        return handleFormatPickupCard(item);
    })

    const listWrapper = document.querySelector(".pick-up-points");
    if (clearArea === true) {
        listWrapper.innerHTML = cards.join('');
    }
    else {
        listWrapper.innerHTML = listWrapper.innerHTML + cards.join('');
    }
    handleOrder();
    handleClickOnPickItem();
}

async function findPlaces(boundaries, count= 0, clearArea= true) {
    let post_office = document.querySelector('.select-delivery-type-opt.active');
    if (post_office === null) {
        post_office = document.querySelector('#post_offices .select-delivery-type-opt');
        post_office.classList.add('active');
    }
    myMap.geoObjects.removeAll();

    let url = '/delivery-points',
        city = document.getElementById('delivery_city').value.includes(',')
            ? document.getElementById('delivery_city').value.split(',')[0]
            : document.getElementById('delivery_city').value;

    do {
        let response = await axios.get(url, {
            params: {
                lms: post_office.dataset.name,
                cityName: city
            }
        })

        displayPlaces(response.data, clearArea);
        clearArea = false;
        url = response.data?.links?.next ?? null;
    } while (url)

    handleOfficeZoom();
    handleToggleLoading(false);
}

const loadDeliveryPlaces = async () => {
    let location_name = document.querySelector('.find-address-input').value;
    if (location_name === '' || location_name ==null) {
        return;
    }

    let border_inp = document.getElementById('search_borders');
    const border = border_inp.value;
    const center = border_inp.dataset.center.split(',');
    myMap.setCenter(center, 10, {

    });
    await findPlaces(border);
};

function locationItemInit(el) {
    el.addEventListener('click', async () => {
        closeCartTab('coruier_tab');

        locationItemClickHandler(el.dataset.value, el.dataset.city, el.dataset.state)

        closeCartTab('pickup_delivery_tab');
        // Saving place coordinates to input

        initMapItems(el.dataset.value)

        $.magnificPopup.close();
    })
}

function initMapItems(address) {
    ymaps.geocode(address, {
        kind: 'locality',
        results: 10
    }).then(async (res) => {
        let boundaries = res.geoObjects.get(0).properties.get('boundedBy');
        let border_inp = document.getElementById('search_borders');
        border_inp.value = (boundaries[0][1] + ',' + boundaries[0][0])
            + '~'
            + (boundaries[1][1] + ',' + boundaries[1][0]);
        let center = res.geoObjects.get(0).geometry.getCoordinates();
        border_inp.dataset.center = center[0] + ',' + center[1];

        await loadDeliveryPlaces();
    })
}

function locationItemClickHandler(address, city, state) {
    $('input:radio[name="delivery"]').prop('checked', false)

    document.querySelector('.find-address-input').value = address;
    let prompt = document.getElementById('suggest_location');
    prompt.innerHTML = "";
    let areaElement = document.getElementById('area');
    areaElement.dataset.value = address;
    areaElement.innerText = address;
    let coruier_city = document.querySelector('.addmodal__city');
    if (coruier_city) {
        coruier_city.innerText = address;
    }

    document.getElementById('delivery_contaniner').classList.add('active');

    $('#delivery_state').val(state).change()
    $('#delivery_city').val(city).change()
}

async function handleSearch(ev) {
    let search = 'Россия, ' + ev.currentTarget.value;
    axios.get('https://suggest-maps.yandex.ru/v1/suggest', {
        params: {
            apikey: SUGGEST_API_KEY,
            types: 'locality',
            text: search,
            print_address: 1
        }
    }).then(function (res) {
        let prompt = document.getElementById('suggest_location');
        prompt.innerHTML = "";
        res.data.results.forEach((el) => {
            let elData = document.createElement('li');
            let location_title = el.title.text;
            if (el.subtitle?.text) {
                location_title += ', ' + el.subtitle.text;
            }

            let state = '',
                city = '';
            for (const componentKey in el.address.component) {
                if (el.address.component[componentKey].kind.includes('PROVINCE'))
                    state = el.address.component[componentKey].name;
                if (el.address.component[componentKey].kind.includes('LOCALITY') && city.length < 1)
                    city = el.address.component[componentKey].name;
            }
            if (!state)
                state = city;

            location_title = el.address.formatted_address;

            elData.innerHTML = location_title;
            elData.classList.add('location_item');
            elData.dataset.value = location_title;

            elData.dataset.state = state;
            elData.dataset.city = city;

            prompt.appendChild(elData);
            locationItemInit(elData);
        });
        prompt.classList.add('active')
    })
}

function initDeliveryOptions() {
    const select = document.querySelector(".select-delivery-type");
    document.querySelectorAll('.select-delivery-type-opt').forEach((el) => {
        let delivery_value = document.querySelector('.select-delivery-type-value');
        el.addEventListener('click', async () => {
            $('#delivery_service').val(el.dataset.value).change()

            document.querySelector('.select-delivery-type-opt.active').classList.toggle('active');
            el.classList.toggle('active');
            delivery_value.innerText = el.dataset.type;
            select.blur();
            handleToggleLoading(true);
            await loadDeliveryPlaces();
        });
    })
}

function handleSubmitDeliveryAddress(ev, id) {
    $('#local_delivery_point_id').val(id).change();
    $('#delivery_street').val(ev.currentTarget.dataset.street).change();
    $('#delivery_house').val(ev.currentTarget.dataset.house).change();

    ymaps.geocode(ev.currentTarget.dataset.address, {results: 1}).then(function (res) {
        var firstGeoObject = res.geoObjects.get(0),
            vPostal = firstGeoObject.properties.get('metaDataProperty').GeocoderMetaData.Address.postal_code;

        $('#delivery_zip').val(vPostal).change();
    })

    let pickup_addr = document.getElementById('pickup_addr');
    let address = ev.currentTarget.dataset.address;
    let post_name = ev.currentTarget.dataset.post_name;
    pickup_addr.innerText = address + ', ' + post_name;
    pickup_addr.dataset.address = address;
    let output_inp = document.getElementById(ADDRESS_OUTPUT_ID);
    output_inp.value = address + ', ' + post_name;
    output_inp.dataset.delivery_type = PICKUP_DELIVERY;
    $(output_inp).change();
    pickup_addr.dataset.post_name = post_name;

    showCartTab('pickup_delivery_tab');
    $.magnificPopup.close();
}

function showCartTab(id) {
    document.querySelector('.cartstep__tab.active')?.classList.toggle('active');
    document.getElementById(id).classList.toggle('active');
}

function closeCartTab(id) {
    document.getElementById(id).classList.remove('active');
}

function handleClickStreetOption(ev) {
    let street_option = ev.currentTarget;
    let search = document.getElementById('street_house_inp');
    search.value = street_option.dataset.address;
    $(search).trigger('change')
    let suggest_box = document.querySelector('.suggest_box__variants');
    suggest_box.classList.toggle('active');
}

function initStreetOption(address) {
    let street_option = document.createElement('li');
    street_option.dataset.address = address;
    street_option.innerText = address;
    street_option.addEventListener('click', handleClickStreetOption);
    return street_option;
}

async function handleSearchStreetHouse(ev) {
    let search_inp = ev.currentTarget;
    let location_name = document.querySelector('.addmodal__city').innerText;
    let border_inp = document.getElementById('search_borders');
    axios.get('https://suggest-maps.yandex.ru/v1/suggest', {
        params: {
            text: location_name + ', ' + search_inp.value,
            types: 'street',
            apikey: SUGGEST_API_KEY,
            print_address: 1,
            bbox: border_inp.value,
            rspn: 1
        }
    }).then((res) => {
        let suggest_box = document.querySelector('.suggest_box__variants');
        suggest_box.innerHTML = "";
        suggest_box.classList.toggle('active');
        res.data.results.forEach((suggestion) => {
            suggest_box.appendChild(
                initStreetOption(suggestion.title?.text)
            );
        })
    })
}

function initStreetSearch() {
    let search = document.getElementById('street_house_inp');
    search.addEventListener('input', handleSearchStreetHouse);
}

function initPickupModalNav() {
    document.querySelectorAll('.modalpanel__nav__link').forEach(
        (el, idx) => {
            el.addEventListener('click', (ev) => {
                document.querySelector('.modalpanel__nav__link.active')?.classList.toggle('active');
                el.classList.toggle('active');
                let contentBlock = document.querySelector('.pickup-content');
                let percentTranslate = (-idx * contentBlock.parentElement.clientWidth);
                contentBlock.style['transform'] = `translateX(${percentTranslate}px)`;
                document.querySelector('.pickup-content div.active')?.classList.toggle('active');
                document.getElementById(el.dataset.tab).classList.toggle('active')
            })
        }
    )
}

initStreetSearch();

initPickupModalNav();
document.getElementById('changecity_init').addEventListener('click', () => {
    searchInit()
})

document.querySelectorAll('li.location_item').forEach((el) => locationItemInit(el))

const showMaps = () => {
    let locationField = document.getElementById('area');
    if (typeof locationField.dataset.value !== 'string')
        return;
    setTimeout(async () => {
        initDeliveryOptions();
        handleToggleLoading(true);
        // await loadDeliveryPlaces();
        $(".select-delivery-type-opt:first").click()
    }, 600)
}

document.getElementById('map_init_btn').addEventListener('click', showMaps)
document.getElementById('show_map_link').addEventListener('click', showMaps)
document.getElementById('coruier_form').addEventListener('submit', (ev) => {
    ev.preventDefault();
    let location = document.querySelector('.addmodal__city').innerText;
    let address = document.getElementById('street_house_inp').value;
    if (address == null || address == '')
        return;

    let newAddressAdditional = [];
    $('#address_additional input').each(function (item, i) {
        if (this.value.length > 0)
            newAddressAdditional.push($(this).prev().text() + ` - ${this.value}`)
    })

    if (newAddressAdditional.length > 0)
        address = address + ' | ' + newAddressAdditional.join(', ')

    document.getElementById('courier_addr').innerText = location + ', ' + address;
    let output_inp = document.getElementById(ADDRESS_OUTPUT_ID);
    output_inp.value = location + ', ' + address;
    $(output_inp).change()
    output_inp.dataset.delivery_type = COURIER_DELIVERY;

    showCartTab('coruier_tab');
    $.magnificPopup.close();
})


