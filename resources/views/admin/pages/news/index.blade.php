@extends('admin.layout.default')

@section('title', 'Danh sách bài viết')

@section('breadcrumb')
    {{renderBreadcrumb('Danh sách bài viết', [['name' => 'Trang chủ', 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <a type="button" class="btn btn-success" href="{{route('admin.news.create')}}">
                {{'Thêm bài viết'}}
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 col-lg-6">
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
                        @include('admin.pages.news.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/news/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"></link>
    <link type="text/css" href="{{asset('css/admin/news/index.css')}}" rel="stylesheet" />
@endsection
