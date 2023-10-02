@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Категории подписок</h5>
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
                    <div class="row">
                        <div class="col">
                            <div class="mb-7">
                                <form method="GET">
                                    <div class="input-icon">
                                        <input id="search_input" type="text" name="search"
                                               data-type="{{ request()->get('type') }}"
                                               class="form-control form-control-solid"
                                               placeholder="Поиск" value="{{ request()->input('search') }}"/>
                                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_CREATE))
                        <div class="col-auto">
                            <button data-toggle="modal" data-target="#createFaqModal" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
                            </button>
                        </div>
                        @endif
                    </div>

                    <div id="table_data">
                    @include('admin.subscriptions.categories_table')
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

    @include('admin.subscriptions.modals-category.create')
    @include('admin.subscriptions.modals-category.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        // Initialization
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


        $(document).on('click', '.update', loadCategory);

        function loadCategory() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.subscription-category.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {

                    $('#updateId').val(id);

                    $('#updateName').val(response.name);
                }, error: function (response) {
                    console.log(response)
                }
            });
        }
    </script>
@endsection

