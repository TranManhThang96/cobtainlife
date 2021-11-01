@extends('admin.layout.default')

@section('title', 'Thêm banner')

@section('breadcrumb')
{{renderBreadcrumb('Thêm banner', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách banner', 'link' => route('admin.banners.index')]
    ])}}
@endsection

@section('content')
<form id="banners-frm" method="POST" action="{{route('admin.banners.update', ['banner' => $banner->id])}}">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="banner-description" class="col-sm-2 text-right font-weight-bold">Hình Ảnh</label>
                <div class="col-sm-10">
                    <div id="banner-image">
                        <input name="image" id="image-input" value="{{old('image', $banner['image'])}}" type="hidden" />
                        <img id="image-preview" src="{{old('image', $banner['image']) ? asset('storage'.old('image', $banner['image'])) : asset('assets/images/no-image.png')}}" alt="no-image" />
                        <div id="banner-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <small class="form-text text-muted">Hình ảnh tốt nhất 1920x900.</small>
                    <x-custom-error field="image" />
                </div>
            </div>


            <div class="form-group row">
                <label for="banner-sort" class="col-sm-2 text-right font-weight-bold">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort') ?? $banner->sort}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="banner-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="banner-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="banner-status" {{(old('status') ?? $banner->status) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="banner-html" class="col-sm-2 text-right font-weight-bold">HTML</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="banner-html" rows="5" name="html">{{old('html') ?? $banner->html}}</textarea>
                    <x-custom-error field="html" />
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.banners.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/cbanners/add.js')}}"></script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('css/admin/cbanners/add.css')}}" rel="stylesheet" />
@endsection