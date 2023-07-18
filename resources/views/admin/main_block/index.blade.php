@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">FAQ</h5>
@endsection
@section('content')


    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body pb-3">
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="mb-7">--}}
{{--                                <form method="GET">--}}
{{--                                    <div class="input-icon">--}}
{{--                                        <input id="search_input" type="text" name="search"--}}
{{--                                               data-type="{{ request()->get('type') }}"--}}
{{--                                               class="form-control form-control-solid"--}}
{{--                                               placeholder="Поиск" value="{{ request()->input('search') }}"/>--}}
{{--                                        <span><i class="flaticon2-search-1 text-muted"></i></span>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <button data-toggle="modal" data-target="#createFaqModal" class="btn btn-primary font-weight-bold">--}}
{{--                                <i class="fas fa-plus mr-2"></i>Добавить--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div id="table_data">
                    @include('admin.main_block._table')
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.main_block.modals.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 450
                }));
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            KTSummernoteDemo.init();
            var createImagePlugin = new KTImageInput('updateImagePlugin');
            var createPageImagePlugin = new KTImageInput('updatePageImagePlugin');
        });


        $(document).on('click', '.updateBlock', loadBlock);

        function loadBlock() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.main-block.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateBlockId').val(id);
                    $('#updateBlockTitle').val(response.title);
                    $('#updateImagePlugin').css('background-image', 'url("/images/uploads/main_block/' + response.image_path + '")');
                    $('#updateBlockContent').summernote('code', response.content)
                }, error: function (response) {
                    console.log(response)
                }
            });
        }

        {{--$(document).on('change', '.active_switch', function(e) {--}}
        {{--    let switch_input = this,--}}
        {{--        status = switch_input.checked;--}}

        {{--    let data = {--}}
        {{--        id: switch_input.dataset.id,--}}
        {{--    }--}}

        {{--    if (status) {--}}
        {{--        data.is_active = true--}}
        {{--    }--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route('admin.faq.update') }}',--}}
        {{--        method: "POST",--}}
        {{--        data: data,--}}
        {{--        success: function (data) {--}}
        {{--            switch_input.checked = status--}}
        {{--        },--}}
        {{--        error: function () {--}}
        {{--            switch_input.checked = !status--}}
        {{--        }--}}
        {{--    })--}}

        {{--})--}}
    </script>
@endsection

