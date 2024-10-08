<!-- Modal -->
<div class="modal fade" id="createPromotionModal" tabindex="-1" role="dialog"
     aria-labelledby="createPromotionModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPromotionModalTitle">Создать акцию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createPromotionForm" action="{{ route('admin.promotions.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    @include('admin.promotions._form', ['promotion' => new \App\Models\Promotion])

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        $(document).on('submit', '#createPromotionForm', function (e) {
            console.log(this)
            e.preventDefault();
            const $form = $(this),
                formData = new FormData(this)

            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $form.find('[type="submit"]').prop('disabled', true)
                },
                success: function (response, status, jqXHR) {
                    location.href = response.redirect_url
                },
                error: function (jqXHR, status, error) {
                    if (jqXHR.status === 422)
                        showErrors(jqXHR.responseJSON.errors);
                    console.log(jqXHR, status, error)
                },
                complete: function () {
                    $form.find('[type="submit"]').prop('disabled', false)
                }
            })

            return false;
        })
    }, 1000)

    function showErrors(errors, feedbackClass = 'invalid-feedback') {
        for (let name in errors) {
            const $el = $(`[name=${name}]`).addClass('is-invalid');
            if ($el.next().hasClass(feedbackClass))
                $el.next().text(errors[name].join(' | '))
            else
                $el.after(`<span class="${feedbackClass}">${errors[name].join(' | ')}</span>`)
        }

        document.querySelector('.is-invalid').scrollIntoView({behavior: 'smooth'})
    }
</script>
