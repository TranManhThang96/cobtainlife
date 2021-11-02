@extends('admin.layout.default')

@section('title', 'Sửa nhãn hiệu')

@section('breadcrumb')
{{renderBreadcrumb('Sửa nhãn hiệu', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách nhãn hiệu', 'link' => route('admin.brands.index')]
    ])}}
@endsection

@section('content')
<form id="brand-frm" method="POST" action="{{route('admin.brands.update', ['brand' => $brand->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$brand->id}}"/>
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="brand-title" class="col-sm-2 text-right font-weight-bold">
                    Tên nhãn hiệu <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <input name="name" type="text" value="{{old('name') ?? $brand->name}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="brand-name" />
                    <x-custom-error field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="brand-sort" class="col-sm-2 text-right font-weight-bold">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort') ?? $brand->sort}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="brand-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="brand-description" class="col-sm-2 text-right font-weight-bold">Hình ảnh</label>
                <div class="col-sm-10">
                    <div id="brand-image">
                        <input name="image" id="image-input" value="{{old('image') ?? $brand->image}}" type="hidden" />
                        <img id="image-preview" src="{{old('image', $brand->image) ? asset('storage'.old('image', $brand->image)) : asset('assets/images/no-image.png')}}" alt="no-image" />
                        <div id="brand-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="image" />
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.brands.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/brands/add.js')}}"></script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('css/admin/brands/add.css')}}" rel="stylesheet" />
@endsection