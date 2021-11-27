@extends('admin.layout.default')

@section('title', 'Cấu hình cửa hàng')

@section('breadcrumb')
{{renderBreadcrumb('Cấu hình cửa hàng', [['name' => 'Trang chủ', 'link' => '/']])}}
@endsection

@section('content')
<div class="card" style="min-height: 80vh;">
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="true">
                    Cửa hàng
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false">
                    Đơn hàng
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-email-tab" data-toggle="pill" href="#pills-email" role="tab" aria-controls="pills-email" aria-selected="false">
                    Email
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-comment-tab" data-toggle="pill" href="#pills-comment" role="tab" aria-controls="pills-comment" aria-selected="false">
                    Bình luận
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-client-say-tab" data-toggle="pill" href="#pills-client-say" role="tab" aria-controls="pills-client-say" aria-selected="false">
                    Nhận xét trang chủ
                </a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
                @include('admin.pages.configs.components.store')
            </div>
            <div class="tab-pane fade" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab">
                Order
            </div>
            <div class="tab-pane fade" id="pills-email" role="tabpanel" aria-labelledby="pills-email-tab">
                @include('admin.pages.configs.components.email')
            </div>
            <div class="tab-pane fade" id="pills-comment" role="tabpanel" aria-labelledby="pills-comment-tab">
                @include('admin.pages.configs.components.comment')
            </div>
            <div class="tab-pane fade" id="pills-client-say" role="tabpanel" aria-labelledby="pills-client-say-tab">
                @include('admin.pages.configs.components.client_say')
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/configs/index.js')}}"></script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('css/admin/configs/index.css')}}" rel="stylesheet" />
@endsection
