<div class="col-12">
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Ссылка</label>
        <input name="data[link]" type="text" class="form-control" value="{{ $catalogBanner->data['link'] ?? '' }}">
    </div>
    <div class="form-group w-100 filepond-container">
        <label for="horizontalImg960" class=font-weight-bold">Изображение 960x160</label>
        <input id="horizontalImg960" name="data[img_960]" type="file" required
        @isset($catalogBanner->data['img_960']) data-img="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_960']) }}" @endisset>
    </div>
    <div class="form-group w-100 filepond-container">
        <label for="horizontalImg768" class=font-weight-bold">Изображение 768x160</label>
        <input id="horizontalImg768" name="data[img_768]" type="file" required
        @isset($catalogBanner->data['img_768']) data-img="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_768']) }}" @endisset>
    </div>
    <div class="form-group w-100 filepond-container">
        <label for="horizontalImg375" class=font-weight-bold">Изображение 375x160</label>
        <input id="horizontalImg375" name="data[img_375]" type="file" required
        @isset($catalogBanner->data['img_375']) data-img="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_375']) }}" @endisset>
    </div>
</div>

