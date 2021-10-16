@extends('admin.layout.default')

@section('title', 'Sửa danh mục')

@section('breadcrumb')
{{renderBreadcrumb('Sửa danh mục', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách danh mục', 'link' => route('admin.categories.index')]
    ])}}
@endsection

@section('content')
<form id="categories-frm" method="POST" action="{{route('admin.categories.update', ['category' => $category->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$category->id}}"/>
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="category-title" class="col-sm-2 text-right">Tên</label>
                <div class="col-sm-10">
                    <input name="title" type="text"value="{{old('title') ?? $category->title}}" 
                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="category-title"
                />
                    <x-custom-error field="title" />
                </div>
            </div>

            <div class="form-group row">
                <label for="category-parent" class="col-sm-2 text-right">Danh mục cha</label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="parent">
                        <option selected value="{{\App\Enums\DBConstant::NO_PARENT}}">{{\App\Enums\Constant::NO_PARENT}}</option>
                        @if(isset($categories)) 
                            @foreach($categories as $categoryItem)
                                <option value="{{$categoryItem['id']}}" {{(old('parent') ?? $category->parent) == $categoryItem['id'] ? 'selected' : ''}}>{{$categoryItem['label']}}</option>
                            @endforeach 
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="category-sort" class="col-sm-2 text-right">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort') ?? $category->sort}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="category-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="category-top" class="col-sm-2 text-right">Hiển thị ở trang chủ</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="top" value="1" id="category-top" {{(old('top') ?? $category->top) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="category-status" class="col-sm-2 text-right">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="category-status" {{(old('status') ?? $category->status) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="category-description" class="col-sm-2 text-right">Mô tả</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="category-description" rows="5" name="description">{{old('description') ?? $category->description}}</textarea>
                    <x-custom-error field="description" />
                </div>
            </div>

            <div class="form-group row">
                <label for="category-description" class="col-sm-2 text-right">Hình Ảnh</label>
                <div class="col-sm-10">
                    <div id="categories-image">
                        <input name="image" id="image-input" value="{{old('image') ?? $category->image}}" type="hidden" />
                        <img id="image-preview" src="{{(old('image') ?? $category->image) ?? asset('assets/images/no-image.png')}}" alt="no-image" />
                        <div id="categories-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="description" />
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.categories.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/categories/add.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('css/admin/categories/add.css')}}" rel="stylesheet" />
@endsection