<div class="hidden">
    <div class="popupform" id="updateAddressModal">
        <div class="subheading subheading--with-form">Обновить адрес</div>
        <form action="{{route('profile.addresses.update')}}" method="POST" class="form form--box">
            @csrf
            @method('put')
            <div class="form__row">
                <input type="hidden" name="id" id="updId">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Ваше имя *</legend>
                        <input type="text" name="name" id="updName" class="form__input" required>
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Фамилия *</legend>
                        <input type="text" name="surname" id="updSurName" class="form__input" required>
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Номер телефона *</legend>
                        <input type="text" name="phone" id="updPhone" class="form__input" required>
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Электронная почта *</legend>
                        <input type="email" name="email" id="updEmail" class="form__input" required>
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Город</legend>
                        <input type="text" name="city"  id="updCity" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Область</legend>
                        <input type="text" name="region" id="updRegion" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Адрес *</legend>
                <input type="text" name="address" id="updAddress" class="form__input" required>
            </div>
            <button class="btn btn--accent">Добавить</button>
        </form>
    </div>
</div>
