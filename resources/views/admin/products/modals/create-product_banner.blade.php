<style>
    .select2-container {
        width: 100% !important;
    }
</style>
<div class="modal fade" id="createProductBannerModal" tabindex="-1" role="dialog" aria-labelledby="createTagModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTagTitle">Новая статья</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.product_banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group d-flex justify-content-center">
                                <select id="product_banner_create_select" name="banner_id" class="select2 form-control">
                                    @foreach(\App\Models\Banner::where('status', 1)->get() as $banner)
                                        <option value="{{ $banner->id }}">{{ $banner->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn btn-primary mr-2">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
