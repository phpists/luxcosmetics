<form action="{{route('profile.add-address')}}" method="POST" class="form form--box">
    @csrf
    @php($user = auth()->user())
    <div class="form__row">
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Ваше имя *</legend>
                <input type="text" name="name" value="{{$user->name}}" class="form__input" required>
            </div>
        </div>
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Фамилия *</legend>
                <input type="text" value="{{$user->surname}}" name="surname" class="form__input" required>
            </div>
        </div>
    </div>
    <div class="form__row">
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Номер телефона *</legend>
                <input type="text" id="phone_inp" value="{{$user->phone}}" name="phone" class="form__input" required>
            </div>
        </div>
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Электронная почта *</legend>
                <input type="email" value="{{$user->email}}" name="email" class="form__input" required>
            </div>
        </div>
    </div>
    <div class="form__row">
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Город</legend>
                <input type="text" name="city" class="form__input">
            </div>
        </div>
        <div class="form__col form__col--50">
            <div class="form__fieldset">
                <legend class="form__label">Область</legend>
                <input type="text" name="region" class="form__input">
            </div>
        </div>
    </div>
    <div class="form__fieldset">
        <legend class="form__label">Адрес *</legend>
        <input type="text" name="address" class="form__input" required>
    </div>
    <div class="form__ftr">
        <label class="checkbox">
            <input type="checkbox" />
            <div class="checkbox__text">Сделать моим адресом по умолчанию</div>
        </label>
        <div class="form__btns">
{{--            <button class="btn btn--border-main">Отмена</button>--}}
            <button type="submit" class="btn btn--accent">Сохранить</button>
        </div>
    </div>
</form>
