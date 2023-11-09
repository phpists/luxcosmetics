<div class="modalpanel pick-up-pointmodal" id="pick-up-point">
    <div class="modalpanel__title">Выбор<br> пункта выдачи</div>
    <div class="modalpanel__nav">
        <p class="modalpanel__nav__link active" data-tab="map_tab">На карте</p>
        <p class="modalpanel__nav__link" data-tab="points_tab">По списку</p>
    </div>
    <div class="pickup-content">
        <div id="map_tab" class="pick-up-pointmodal__map pickup-tab active">
            <div style="position: relative; width: 100%; height: 80vh;">
                <div id="map" style="width: 100%; height: 100%">

                </div>
            </div>
        </div>
        <div id="points_tab" class="pickup-tab delivery_places_container">
            <div class="delivery_service">
                <button class="select-delivery-type">
                    <div class="select-delivery-type-value">Boxberry</div>
                    <svg
                        width="15"
                        height="15"
                        viewBox="0 0 15 15"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M3 5L7.5 9.5L12 5" fill="none" stroke-width="1.5"></path>
                    </svg>
                    <div class="dropdown" id="post_offices">
                        <div class="select-delivery-type-opt" data-type="Boxberry">
                            Boxberry
                        </div>
                        <div class="select-delivery-type-opt" data-type="СДЭК">СДЭК</div>
                    </div>
                </button>
            </div>
            <div class="pick-up-points">
                <div class="pick-up-point">
                    <div class="pick-up-point__title">Название пукта выдачи</div>
                    <div class="pick-up-point__content">
                        <p>Вайнера ул., 9<br> м. Площадь 1905 года</p>
                        <p>стоимость — <b>бесплатно</b></p>
                        <p>дата доставки — <b>сегодня, 3 октября</b></p>
                        <p>нет оплаты при получении</p>
                        <div class="pick-up-point__ftr">
                            <p><small>Режим работы</small> пн-вс 10:00-22:00</p>
                            <p><small>Контактный телефон</small> 8 800 770 70 21</p>
                        </div>
                    </div>
                    <button class="btn btn--accent">Привезти сюда</button>
                </div>
                <div class="pick-up-point pickup-item" data-id="${place?.id}" data-value="${coordinates[1] + ',' + coordinates[0]}">
                    <div class="pick-up-point__title">${place?.name ?? ""}</div>
                    <div class="pick-up-point__content">
                        <p>${ place?.address ?? ""}</p>
                        <p>стоимость — <b>бесплатно</b></p>
                        <p>дата доставки — <b>сегодня, 3 октября</b></p>
                        <p>нет оплаты при получении</p>
                        <div class="pick-up-point__ftr">
                            <p><small>Режим работы</small> ${place?.Hours.text ?? ""}</p>
                            <p><small>Контактный телефон</small> 8 800 770 70 21</p>
                        </div>
                    </div>
                    <button class="btn btn--accent pickup-item__button" data-id="${place?.id}" data-title="${place?.name}" data-address="${place?.address}">Привезти сюда</button>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay overlay-order"></div>
    <div class="overlay overlay-loading">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            style="
            margin: auto;
            background: none;
            display: block;
            shape-rendering: auto;
          "
            width="200px"
            height="200px"
            viewBox="0 0 100 100"
            preserveAspectRatio="xMidYMid"
        >
            <circle
                cx="50"
                cy="50"
                fill="none"
                stroke="#0a0a0a"
                stroke-width="10"
                r="35"
                stroke-dasharray="164.93361431346415 56.97787143782138"
            >
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    repeatCount="indefinite"
                    dur="1s"
                    values="0 50 50;360 50 50"
                    keyTimes="0;1"
                />
            </circle>
        </svg>
    </div>
</div>
