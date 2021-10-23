@extends('admin.layout.default')

@section('title', 'Danh sách đơn hàng')

@section('breadcrumb')
    {{renderBreadcrumb('Danh sách đơn hàng', [['name' => 'Trang chủ', 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <a type="button" class="btn btn-success" href="{{route('admin.orders.create')}}">
                {{'Thêm đơn hàng'}}
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 col-lg-4">
            <div class="d-flex align-items-center">
                <span>Hiển thị</span>
                <select class="custom-select mx-2 select-per-page" id="select-per-page">
                    <option {{request()->per_page === \App\Enums\Constant::DEFAULT_PER_PAGE ? 'selected' : ''}}
                            value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}">{{\App\Enums\Constant::DEFAULT_PER_PAGE}}</option>
                    <option value="25" {{request()->per_page == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{request()->per_page == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{request()->per_page == 100 ? 'selected' : ''}}>100</option>
                </select>
                <span>Bản ghi</span>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            <form class="form-inline justify-content-end" id="frm-search">
                <div class="form-group mb-2 mr-2">
                    <label class="mr-2">Ngày bắt đầu</label>
                    <input
                        type="text"
                        style="width: 150px;"
                        id="created-at-from"
                        name="created_at_from"
                        value="{{request()->created_at_from ?? ''}}"
                        class="form-control input-sm created-at-range date-time datepicker"
                        data-date-format="dd/mm/yyyy"
                        placeholder="dd/mm/yyyy"
                        auto-close="true"
                    />
                </div>
                <div class="form-group mb-2 mr-2">
                    <label class="mr-2">Ngày kết thúc</label>
                    <input
                        type="text"
                        style="width: 150px;"
                        id="created-to"
                        name="created_at_to"
                        value="{{request()->created_at_to ?? ''}}"
                        class="form-control input-sm created-at-range date-time datepicker"
                        data-date-format="dd/mm/yyyy"
                        placeholder="dd/mm/yyyy"
                        auto-close="true"
                    />
                </div>
                <div class="form-group mb-2">
                    <label for="order-status">Trạng thái</label>
                    <div id="order-status-options" class="ml-2 search-options">
                        <select class="custom-select mr-sm-2 select-order-status" name="status">
                            <option value="">Chọn trạng thái</option>
                            @if(isset($listOrderStatus))
                                @foreach($listOrderStatus as $orderStatus)
                                    <option
                                        value="{{$orderStatus['id']}}" {{request()->status == $orderStatus['id'] ? 'selected' : ''}}>{{$orderStatus['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <label for="query-input" class="sr-only">Query</label>
                    <input type="text" class="form-control" name="q" value="{{request()->q}}"
                           placeholder="Nhập từ khóa"/>
                </div>
                <input type="hidden" name="sort_by" value=""/>
                <input type="hidden" name="order_by" value=""/>
                <input type="hidden" name="per_page" value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}"/>
                <input type="hidden" name="page" value="1"/>
                <button class="btn btn-primary mb-2" id="btn-search">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.orders.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/orders/index.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"></link>
    <link href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('css/admin/orders/index.css')}}" rel="stylesheet" />
@endsection
