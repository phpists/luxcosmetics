<div class="modalpanel addmodal" id="addmodal">
    <div class="modalpanel__title">Адрес<br> доставки</div>
    <div class="addmodal__hdr">
        <div class="addmodal__city">г. Екатеринбург Свердловская обл</div>
        <a href="#changecity" class="btn-edit popup-with-form"><svg class="icon"><use xlink:href="images/dist/sprite.svg#edit"></use></svg> Редактировать</a>
    </div>
    <div class="addmodal__form">
        <form class="form" id="coruier_form">
            <div class="form__row">
                <div class="form__col form__col--100">
                    <div class="form__fieldset">
                        <legend class="form__label">Улица и дом</legend>
                        <input type="text" class="form__input" id="street_house_inp" required>
                        <div class="suggest_box">
                            <ul class="suggest_box__variants" id="suggest_street">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="address_additional">
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Квартира/офис</legend>
                            <input type="text" class="form__input" name="kvartira">
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Домофон</legend>
                            <input type="text" class="form__input" name="domofon">
                        </div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Подъезд</legend>
                            <input type="text" class="form__input" name="podiezd">
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Этаж</legend>
                            <input type="text" class="form__input" name="etaj">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn--accent btn--full" id="submit_coruier_btn">Привезти сюда</button>
        </form>
    </div>

</div>
