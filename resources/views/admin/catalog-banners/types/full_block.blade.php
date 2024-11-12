<div class="col-md-4">
    <div class="form-group w-100 filepond-container">
        <label for="advantagesColor" class=font-weight-bold">Изображение 451×412 (902×824 x2)</label>
        <input name="data[img]" type="file" required
               @isset($catalogBanner->data['img']) data-img="{{ $catalogBanner->getImgSrc($catalogBanner->data['img']) }}" @endisset>
    </div>
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Текст кнопки</label>
        <input name="data[button_text]" type="text" class="form-control" value="{{ $catalogBanner->data['button_text'] ?? '' }}">
    </div>
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Ссылка кнопки</label>
        <input name="data[button_link]" type="text" class="form-control" value="{{ $catalogBanner->data['button_link'] ?? '' }}">
    </div>
</div>

<div class="col-md-8">
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Заголовок</label>
        <input name="data[subject]" type="text" class="form-control" value="{{ $catalogBanner->data['subject'] ?? '' }}" required>
    </div>
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Текст</label>
        <textarea name="data[body]" class="fullBlockBody">{!! $catalogBanner->data['body'] ?? '' !!}</textarea>
    </div>
</div>

<script>
    setInterval(() => {
        $('#{{ $selector }} .fullBlockBody:not(.initialized)').summernote($.extend(summernoteDefaultOptions, {
            height: 300
        })).addClass('initialized');
    })
</script>
