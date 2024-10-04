<div class="col-md-4">
    <div class="form-group w-100 filepond-container">
        <label for="advantagesColor" class=font-weight-bold">Изображение</label>
        <input name="data[img]" type="file" @isset($catalogBanner->data['img']) data-img="{{ $catalogBanner->getImgSrc($catalogBanner->data['img']) }}" @endisset required>
    </div>
</div>

<div class="col-md-8">
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Расположение</label>
        <select name="data[align]" id="advantagesColor" class="form-control" required>
            @foreach(\App\Models\CatalogBanner::ALL_ALIGNS as $value => $title)
                <option value="{{ $value }}" @selected(isset($catalogBanner->data['align']) && $catalogBanner->data['align'] == $value)>{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Ссылка</label>
        <input name="data[link]" type="text" class="form-control" value="{{ $catalogBanner->data['link'] ?? '' }}">
    </div>
</div>
