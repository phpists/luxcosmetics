<div class="row">
    <div class="col-3">
        <div class="form-group w-100 filepond-container">
            <label for="promotionImg" class=font-weight-bold">Изображение (470x304)</label>
            <input id="promotionImg" name="preview_img" type="file" @if($promotion->preview_img) data-value="{{ $promotion->preview_img_src }}" @endif>
        </div>
    </div>
    <div class="col-9">
        <div class="form-group w-100">
            <label for="promotionTitle" class="font-weight-bold">Название</label>
            <input id="promotionTitle" type="text" name="title" class="form-control"
                   value="{{ $promotion->title }}" required>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="promotionTitle" class="font-weight-bold">Действует
                        от-до</label>
                    <div class="input-daterange input-group">
                        <input type="date" class="form-control" name="starts_at"
                               value="{{ $promotion->starts_at?->format('Y-m-d') }}" required/>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                        </div>
                        <input type="date" class="form-control" name="ends_at"
                               value="{{ $promotion->ends_at?->format('Y-m-d') }}" required/>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="promotionIsActive">Активная</label>
                    <div>
                        <span class="switch">
                            <label>
                                <input id="promotionIsActive" type="checkbox" value="1" name="is_active"
                                       @checked($promotion->is_active ?? true)><span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group w-100">
            <label for="promotionShortDescription" class="font-weight-bold">Краткое описание</label>
            <textarea id="promotionShortDescription" name="short_description" class="form-control"
                      required>{{ $promotion->short_description }}</textarea>
        </div>
    </div>
</div>

<hr class="my-3 mx-5">

<div class="row">
    <div class="col">
        <div class="form-group w-100 filepond-container">
            <label for="promotionBgImg" class=font-weight-bold">Главное изображение (1920x557)</label>
            <input id="promotionBgImg" name="bg_img" type="file" @if($promotion->bg_img) data-value="{{ $promotion->bg_img_src }}" @endif>
        </div>

        <div class="form-group w-100">
            <label for="promotionShortContent" class="font-weight-bold">Контент</label>
            <textarea id="promotionShortContent" name="content" class="form-control" required>{!! $promotion->content !!}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-6">
        <div class="form-group w-100">
            <label for="promotionBtnTitle" class="font-weight-bold">Название кнопки</label>
            <input id="promotionBtnTitle" type="text" name="btn_title" class="form-control" value="{{ $promotion->btn_title }}"/>
        </div>
    </div>
    <div class="col col-md-6">
        <div class="form-group w-100">
            <label for="promotionBtnLink" class="font-weight-bold">Ссылка кнопки</label>
            <input id="promotionBtnLink" type="text" name="btn_link" class="form-control" value="{{ $promotion->btn_link }}"/>
        </div>
    </div>
</div>
