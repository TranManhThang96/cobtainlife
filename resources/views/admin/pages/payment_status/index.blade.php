@extends('admin.layout.default')

@section('title', 'Danh sách trạng thái')

@section('breadcrumb')
    {{renderBreadcrumb('Danh sách trạng thái thanh toán', [['name' => 'Trang chủ', 'link' => '/']])}}
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-md-6 col-lg-6">
            <div class="d-flex align-items-center">
            <button type="button" class="btn btn-success" id="btn-add-payment-status">
                {{'Thêm trạng thái'}}
            </button>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <form class="form-inline justify-content-end" id="frm-search">
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
                        @include('admin.pages.payment_status.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-payment-status" tabindex="-1" aria-labelledby="modal-add-payment-status"
         aria-hidden="true">
        @include('admin.pages.payment_status.add')
    </div>

    <div class="modal fade" id="modal-edit-payment-status" tabindex="-1" aria-labelledby="modal-edit-payment-status"
         aria-hidden="true">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/payment_status/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/payment_status/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/payment_status/edit.js')}}"></script>
@endsection

@section('css')
    
@endsection
