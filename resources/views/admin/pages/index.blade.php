@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Статические страницы</h5>
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
                        <div class="col-auto">
                            <a href="{{route('admin.pages.create')}}" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
                            </a>
                        </div>
                    </div>

                    <div id="table_data">

						<!--begin::Table-->
						<div class="table-responsive">
							<table class="table table-head-custom table-vertical-center">
								<thead>
								<tr>
									<th class="pl-0 text-center">
										ID
									</th>
									<th class="pr-0 text-center">
										Название
									</th>
									<th class="text-center pr-0">
										Ссылка
									</th>
									<th class="pr-0 text-center">
										Действия
									</th>
								</tr>
								</thead>
								<tbody>
								@foreach($pages as $page)
									<tr data-id="{{ $page->id }}">
										<td class="text-center pl-0">
											{{ $page->id }}
										</td>
										<td class="position">
																<span class="text-dark-75 d-block font-size-lg">
																	{{ $page->title }}
																</span>
										</td>
										<td class="text-center">
																<span class="text-dark-75 d-block font-size-lg">
																	<a href="/pages/{{ $page->link }}">{{ $page->link }}</a>
																</span>
										</td>
										<td class="text-center pr-0">
											<form action="{{ route('admin.pages.delete', $page->id) }}" method="POST">
												<a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-sm btn-clean btn-icon">
													<i class="las la-edit"></i>
												</a>
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
														onclick="return confirm('Вы уверены, что хотите удалить вопрос \'{{ $page->name }}\'?')"
														title="Delete"><i class="las la-trash"></i>
												</button>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						<!--end::Table-->


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
@endsection



