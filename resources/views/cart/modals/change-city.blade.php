<div class="modalpanel cityselectmodal" id="changecity">
    <div class="modalpanel__title">Выбрать<br> город</div>
    <form action="" class="form">
        <div class="form__fieldset" style="position:relative;">
            <legend class="form__label">Найти город</legend>
            <input type="text" class="form__input find-address-input" style="padding-right: 32px;">
            <span class="form-clear d-none">
                <svg class="icon" style="max-height: 100%;"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg>
            </span>
        </div>
    </form>
    <div class="cityselectmodal__subtitle">Вы можете выбрать более 150 000 населённых пунктов по всей Российской Федерации.</div>
    <div class="typography">
        <ul class="cityselectmodal__variants" id="suggest_location">
        </ul>
    </div>
</div>
