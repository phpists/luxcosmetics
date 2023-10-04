const SUGGEST_API_KEY = '05c41b12-223c-47e0-a0df-9403b108f3cd';
const SEARCH_API_KEY = 'd46bfdd1-d9ca-4f94-959e-5c09d2a427e1';
var myMap;
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

ymaps.ready(initYandex);

const handleRenderOrderModal = (title, address) => {
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
          <button data-address="${address ?? ''}" data-post_name="${title?? ''}" class="submit submit_address">Привезти сюда</button>
      </div>
    `;

    modal.innerHTML = "";
    modal.innerHTML = content;
    const closeBtn = document.querySelector(".overlay-order .closeBtn");
    modal.classList.add("active");
    const submitBtn = document.querySelector(".submit_address");
    closeBtn.addEventListener("click", () => modal.classList.remove("active"));
    submitBtn.addEventListener('click', (ev) => {
        handleSubmitDeliveryAddress(ev);
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

            handleRenderOrderModal(title, address);
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

const handleFormatPickupCard = (place, coordinates) =>
    `
    <div class="pick-up-point pickup-item" data-id="${place?.id}" data-value="${coordinates[1] + ',' + coordinates[0]}">
        <div class="pick-up-point__title">${place?.name ?? ""}</div>
        <div class="pick-up-point__content">
            <p>${ place?.address ?? ""}</p>
            <p>стоимость — <b>бесплатно</b></p>
            <p>дата доставки — <b>сегодня, 3 октября</b></p>
            <p>нет оплаты при получении</p>
            <div class="pick-up-point__ftr">
                <p><small>Режим работы</small> ${place?.Hours?.text ?? ""}</p>
                <p><small>Контактный телефон</small> 8 800 770 70 21</p>
            </div>
        </div>
        <button class="btn btn--accent pickup-item__button" data-id="${place?.id}" data-title="${place?.name}" data-address="${place?.address}">Привезти сюда</button>
    </div>
`;

function handleClickBaloon(post_office_id) {
    const listWrapper = document.querySelector(".pick-up-points");

    document.querySelector('.pickup-item.active')?.classList.toggle('active');
    let selectedBaloon = document.querySelector(`.pickup-item[data-id='${post_office_id}']`);

    selectedBaloon?.classList.toggle('active')

    listWrapper.scroll({
        top: selectedBaloon?.offsetTop - 200,
        behavior: "smooth",
    });
}

function setMarker(post_office){
    post_office_coordinates = post_office.geometry.coordinates;
    let myGeoObject = new ymaps.Placemark(
        [post_office_coordinates[1], post_office_coordinates[0]],
        {balloonContent: `<h2>${post_office.properties.CompanyMetaData.name}</h2><h3>${post_office.properties.CompanyMetaData.address}</h3><p>${post_office.properties.CompanyMetaData.Hours?.text}</p>`},
        { preset: 'islands#icon', iconColor:'#0095b6' }
    );
    myGeoObject.events.add('click', () => {
        handleClickBaloon(post_office.properties.CompanyMetaData.id);
    })
    myMap.geoObjects.add(myGeoObject);
}

function displayPlaces(places, clearArea) {
    let cards = places.data.features.map((el) => {
        setMarker(el);
        return handleFormatPickupCard(el.properties.CompanyMetaData, el.geometry.coordinates);
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

async function findPlaces(boundaries, count=0, clearArea=true) {
    let post_office = document.querySelector('.select-delivery-type-opt.active');
    let res = await axios.get('https://search-maps.yandex.ru/v1/', {
        params: {
            apikey: SEARCH_API_KEY,
            text: post_office.dataset.type,
            type: 'biz',
            lang: 'ru_RU',
            bbox: boundaries,
            rspn: 1,
            results: 50,
            skip: count
        }
    });
    if (count === 0) {
        myMap.geoObjects.removeAll();
    }
    count += 50;
    displayPlaces(res, clearArea);
    let getNumber = parseInt(res.data.properties.ResponseMetaData.SearchResponse.found);
    if (getNumber > count) {
        await findPlaces(boundaries, count, false);
    }
    else  {
        handleOfficeZoom();
        handleToggleLoading(false);
    }
}

const loadDeliveryPlaces = async () => {
    let location_name = document.querySelector('.find-address-input').value;
    if (location_name === '' || location_name ==null) {
        return;
    }
    let location = ymaps.geocode(location_name, {
        kind: 'locality',
        results: 10
    });
    location.then((res) => {
        let boundaries = res.geoObjects.get(0).properties.get('boundedBy');
        let center = res.geoObjects.get(0).geometry.getCoordinates();
        myMap.setCenter(center, 10, {

        });
        const border = (boundaries[0][1] + ',' + boundaries[0][0])
            + '~'
            + (boundaries[1][1] + ',' + boundaries[1][0])
        findPlaces(border);
    });
};

function locationItemInit(el) {
    el.addEventListener('click', async () => {
        document.querySelector('.find-address-input').value = el.dataset.value;
        let prompt = document.getElementById('suggest_location');
        prompt.innerHTML = "";
        let areaElement = document.getElementById('area');
        areaElement.dataset.value = el.dataset.value;
        areaElement.innerText = el.dataset.value;
        let coruier_city = document.querySelector('.addmodal__city');
        if (coruier_city) {
            coruier_city.innerText = el.dataset.value;
        }
        closeCartTab('pickup_delivery_tab');
        // await loadDeliveryPlaces();
    })
}

async function handleSearch(ev) {
    let search = ev.currentTarget.value;
    axios.get('https://suggest-maps.yandex.ru/v1/suggest', {
        params: {
            apikey: SUGGEST_API_KEY,
            types: 'locality',
            text: search
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
            elData.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
            </svg> <span>${location_title}</span>`;
            elData.classList.add('location_item');
            elData.dataset.value = location_title;
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
            document.querySelector('.select-delivery-type-opt.active').classList.toggle('active');
            el.classList.toggle('active');
            delivery_value.innerText = el.dataset.type;
            select.blur();
            handleToggleLoading(true);
            await loadDeliveryPlaces();
        });
    })
}

function handleSubmitDeliveryAddress(ev) {
    let pickup_addr = document.getElementById('pickup_addr');
    let address = ev.currentTarget.dataset.address;
    let post_name = ev.currentTarget.dataset.post_name;
    pickup_addr.innerText = address + ', ' + post_name;
    pickup_addr.dataset.address = address;
    pickup_addr.dataset.post_name = post_name;
    showCartTab('pickup_delivery_tab');
}

function showCartTab(id) {
    document.querySelector('.cartstep__tab.active')?.classList.toggle('active');
    document.getElementById(id).classList.toggle('active');
}

function closeCartTab(id) {
    document.getElementById(id).classList.remove('active');
}
document.getElementById('changecity_init').addEventListener('click', () => {
    searchInit()
})

document.querySelectorAll('li.location_item').forEach((el) => locationItemInit(el))

const showMaps = () => {
    setTimeout(async () => {
        initDeliveryOptions();
        handleToggleLoading(true);
        await loadDeliveryPlaces();
    }, 600)
}

document.getElementById('map_init_btn').addEventListener('click', showMaps)
document.getElementById('show_map_link').addEventListener('click', showMaps)
