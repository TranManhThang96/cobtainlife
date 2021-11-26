@extends('admin.layout.default')

@section('title', 'Lịch sử gửi mail')

@section('breadcrumb')
    {{renderBreadcrumb('Lịch sử gửi mail', [['name' => 'Trang chủ', 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <a type="button" class="btn btn-success" href="{{route('admin.campaigns.create')}}">
                {{'Gửi mail'}}
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.campaigns.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

