<form action="{{route('profile.add-payment-method')}}" class="form form--box" method="POST">
    @csrf
    <div class="form__row">
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Номер карты</legend>
                <input type="text" name="card_number" maxlength="16" id="card_inp" minlength="16" class="form__input" required>
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Срок действия</legend>
                <div class="form__row">
                    <div class="form__col form__col--33">
                        <input type="number" class="form__input" min="1" max="12" name="month" required>
                    </div>
                    <div class="form__col form__col--33">
                        <input type="number" class="form__input" min="{{substr(date("Y"), 2, 2)}}" max="99" name="year" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Фамилия и имя</legend>
                <input type="text" class="form__input" name="full_name" required>
            </div>
            <div class="form__fieldset">
                <legend class="form__label">CVV</legend>
                <div class="form__row">
                    <div class="form__col form__col--33">
                        <input type="text" class="form__input" id="cvv_inp" name="cvv" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form__fieldset">
        <label class="checkbox checkbox--mailer">
            <input type="checkbox" name="is_default"/>
            <div class="checkbox__text">Сделать способом оплаты по умолчанию</div>
        </label>
        <button class="btn btn--accent">Добавить</button>
    </div>
</form>
