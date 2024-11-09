<div class="popupform mfp-hide" id="otpModal">
    <div class="popupform__title">Введите код с СМС</div>
    <div class="addprod" style="display:block;">
        <form action="{{ route('auth.code.verify') }}" method="POST" id="otpForm">
            <input type="hidden" name="phone" required>
            <div class="form__fieldset">
                <legend class="form__label">Код *</legend>
                <input type="text" name="code" class="form__input" required>
                <span class="invalid-feedback" role="alert"><strong></strong></span>
            </div>
        </form>
        <form action="{{ route('auth.code.resend') }}" method="post" id="resendCodeForm" style="display:none;">
            <input type="hidden" name="phone" required>
        </form>
    </div>
    <div class="popupform__btns">
        <button type="submit" form="resendCodeForm" class="btn btn--border-main close">Отправить еще раз
        </button>
        <button type="submit" form="otpForm" class="btn btn--accent">Подтвердить</button>
    </div>
    <div class="popupform__btns">
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('submit', '#otpForm', function (e) {
                e.preventDefault();
                const $form = $(this);
                submitLiveForm($form)
            })

            $(document).on('submit', '#resendCodeForm', function (e) {
                e.preventDefault();
                const $form = $(this);
                $form.find('[name="phone"]').val($('#otpForm').find('[name="phone"]').val())
                submitLiveForm($form)
                $('button:submit[form="resendCodeForm"]').setCooldown(60);
            })
        });
    </script>
@endpush
