@extends('admin.layout.default')

@section('title', 'Thêm sản phẩm')

@section('breadcrumb')
{{renderBreadcrumb('Thêm sản phẩm', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách sản phẩm', 'link' => route('admin.products.index')]
    ])}}
@endsection

@section('content')
<form id="products-frm" method="POST" action="{{route('admin.products.store')}}" name="frm-new">
    @csrf
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 text-right font-weight-bold">
                    Tên <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <input name="name" type="text" value="{{old('name') ?? ''}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="product-name" />
                    <x-custom-error field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="product-description" class="col-sm-2 text-right font-weight-bold">Mô tả</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="product-description" rows="3" name="description">{{old('description') ?? ''}}</textarea>
                    <x-custom-error field="description" />
                </div>
            </div>

            <div class="form-group row">
                <label for="editor_content" class="col-sm-2 text-right font-weight-bold">
                    Nội dung chính <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                        <textarea id="editor_content" name="content" rows="30"
                                  class="{{$errors->has('content') ? 'invalid-border' : ''}}">{!!  old('content') ?? '' !!}</textarea>
                        <x-custom-error field="content"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-category" class="col-sm-2 text-right font-weight-bold">
                    Danh mục <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-category" name="category_id">
                        @if(isset($categories)) 
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}" {{old('category_id') == $category['id'] ? 'selected' : ''}}>{{$category['label']}}</option>
                            @endforeach 
                        @endif
                    </select>
                    <x-custom-error field="category_id"/>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="product-image" class="col-sm-2 text-right font-weight-bold">
                    Hình ảnh <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <!-- image main -->
                    <div class="row main-image mx-0 image-product">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" name="image" class="form-control" id="product-image">
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="product-image" data-preview="preview-image" data-type="product">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <x-custom-error field="image"/>
                    </div>    

                    <!-- sub images -->
                    <div class="group-image">
                    </div>

                    <!-- btn add image -->
                    <button type="button" id="add-sub-image" class="btn btn-flat btn-success mt-3">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Thêm ảnh
                    </button>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-sku" class="col-sm-2 text-right font-weight-bold">SKU</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sku" type="text" value="{{old('sku') ?? ''}}" class="form-control {{$errors->has('sku') ? 'is-invalid' : ''}}" id="product-sku" />
                        <x-custom-error field="sku" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-sku" class="col-sm-2 text-right font-weight-bold">Độ ẩm</label>
                <div class="col-sm-10">
                    @foreach(\App\Enums\Constant::HUMIDITY as $humidityItem)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="humidity-{{$humidityItem['value']}}" 
                                name="humidity" 
                                class="custom-control-input" 
                                value="{{$humidityItem['value']}}" 
                                {{old('humidity') == $humidityItem['value'] ? 'checked' : ''}}
                            />
                            <label class="custom-control-label" for="humidity-{{$humidityItem['value']}}">{{$humidityItem['title']}}</label>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="form-group row">
                <label for="product-sku" class="col-sm-2 text-right font-weight-bold">Ánh sáng</label>
                <div class="col-sm-10">
                    @foreach(\App\Enums\Constant::LIGHT as $lightItem)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="light-{{$lightItem['value']}}" 
                                name="light" 
                                class="custom-control-input" 
                                value="{{$lightItem['value']}}" 
                                {{old('light') == $lightItem['value'] ? 'checked' : ''}}
                            />
                            <label class="custom-control-label" for="light-{{$lightItem['value']}}">{{$lightItem['title']}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group row">
                <label for="product-sku" class="col-sm-2 text-right font-weight-bold">Lượng nước</label>
                <div class="col-sm-10">
                    @foreach(\App\Enums\Constant::WATER as $waterItem)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="water-{{$waterItem['value']}}" 
                                name="water" 
                                class="custom-control-input" 
                                value="{{$waterItem['value']}}" 
                                {{old('water') == $waterItem['value'] ? 'checked' : ''}}
                            />
                            <label class="custom-control-label" for="water-{{$waterItem['value']}}">{{$waterItem['title']}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group row">
                <label for="product-brand" class="col-sm-2 text-right font-weight-bold">
                    Nhãn hàng (<a href="{{route('admin.brands.create')}}"><i class="fa fa-link" aria-hidden="true"></i></a>)
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-brand" name="brand_id">
                        <option selected value="">Chọn nhãn hàng</option>
                        @if(isset($brands)) 
                            @foreach($brands as $brand)
                                <option value="{{$brand['id']}}" {{old('brand_id') == $brand['id'] ? 'selected' : ''}}>{{$brand['name']}}</option>
                            @endforeach 
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-supplier" class="col-sm-2 text-right font-weight-bold">
                    Nhà cung cấp (<a href="{{route('admin.suppliers.create')}}"><i class="fa fa-link" aria-hidden="true"></i></a>)
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-supplier" name="supplier_id">
                        <option selected value="">Chọn nhà cung cấp</option>
                        @if(isset($suppliers)) 
                            @foreach($suppliers as $supplier)
                                <option value="{{$supplier['id']}}" {{old('supplier_id') == $supplier['id'] ? 'selected' : ''}}>{{$supplier['name']}}</option>
                            @endforeach 
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-cost" class="col-sm-2 text-right font-weight-bold">Giá cost (giá nhập)</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="cost" value="{{old('cost') ?? 0}}" class="form-control {{$errors->has('cost') ? 'is-invalid' : ''}}" id="product-cost" data-type='currency'/>
                        <x-custom-error field="cost" />
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <label for="product-price" class="col-sm-2 text-right font-weight-bold">Giá</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="price" value="{{old('price') ?? 0}}" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" id="product-price" data-type='currency'/>
                        <x-custom-error field="price" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="add-product-promotion" class="col-sm-2 text-right font-weight-bold">Giá khuyến mãi</label>
                <div class="col-sm-10">
                    <button type="button" id="add-product-promotion" class="btn btn-flat btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i> Thêm giá khuyến mãi
                    </button>
                    
                </div>
            </div>

            <div class="form-group row">
                <label for="product-stock" class="col-sm-2 text-right font-weight-bold">Số lượng trong kho</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="stock" type="number" value="{{old('stock') ?? 0}}" class="form-control {{$errors->has('stock') ? 'is-invalid' : ''}}" id="product-stock" />
                        <x-custom-error field="stock" />
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <label for="product-weight-class" class="col-sm-2 text-right font-weight-bold">
                    Đơn vị khối lượng (<a href="{{route('admin.weight-class.index')}}"><i class="fa fa-link" aria-hidden="true"></i></a>)
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <select class="custom-select custom-select-2 mr-sm-2 select-weight-class" name="weight_class">
                            <option selected value="">Chọn đơn vị khối lượng </option>
                            @if(isset($weightClasses)) 
                                @foreach($weightClasses as $weightClass)
                                    <option value="{{$weightClass['name']}}" {{old('weight_class') == $weightClass['name'] ? 'selected' : ''}}>{{$weightClass['description']}}</option>
                                @endforeach 
                            @endif
                        </select>
                        <x-custom-error field="weight_class" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-weight" class="col-sm-2 text-right font-weight-bold">Khối lượng</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="weight" type="number" value="{{old('weight') ?? 0}}" class="form-control {{$errors->has('weight') ? 'is-invalid' : ''}}" id="product-weight" />
                        <x-custom-error field="weight" />
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <label for="product-length-class" class="col-sm-2 text-right font-weight-bold">
                    Đơn vị kích thước (<a href="{{route('admin.length-class.index')}}"><i class="fa fa-link" aria-hidden="true"></i></a>)
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-weight-class" name="length_class">
                        <option selected value="">Chọn đơn vị kích thước</option>
                        @if(isset($lengthClasses)) 
                            @foreach($lengthClasses as $lengthClass)
                                <option value="{{$lengthClass['name']}}" {{old('length_class') == $lengthClass['name'] ? 'selected' : ''}}>{{$lengthClass['description']}}</option>
                            @endforeach 
                        @endif
                    </select>
                    <x-custom-error field="length_class" />
                </div>
            </div>

            <div class="form-group row">
                <label for="product-length" class="col-sm-2 text-right font-weight-bold">Kích thước</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="length" type="number" value="{{old('length') ?? 0}}" class="form-control {{$errors->has('length') ? 'is-invalid' : ''}}" id="product-length" />
                        <x-custom-error field="length" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-height" class="col-sm-2 text-right font-weight-bold">Chiều cao</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="height" type="number" value="{{old('height') ?? 0}}" class="form-control {{$errors->has('height') ? 'is-invalid' : ''}}" id="product-height" />
                        <x-custom-error field="height" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-width" class="col-sm-2 text-right font-weight-bold">Chiều rộng</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="width" type="number" value="{{old('width') ?? 0}}" class="form-control {{$errors->has('width') ? 'is-invalid' : ''}}" id="product-width" />
                        <x-custom-error field="width" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-sort" class="col-sm-2 text-right font-weight-bold">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort') ?? 0}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="product-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="product-status" checked>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-new-arrival" class="col-sm-2 text-right font-weight-bold">Sản phẩm mới về</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="new_arrival" value="1" id="product-new-arrival">
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-hot" class="col-sm-2 text-right font-weight-bold">Sản phẩm hot</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="hot" value="1" id="product-hot">
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <hr/>

            <div class="form-group row mt-3">
                <label for="product-attributes" class="col-sm-2 text-right font-weight-bold">
                    Thuộc tính (<a href="{{route('admin.attribute-group.index')}}"><i class="fa fa-link" aria-hidden="true"></i></a>)
                </label>
                <div class="col-sm-10">
                    @if(isset($shopAttributeGroups)) 
                        @foreach($shopAttributeGroups as $shopAttributeGroup)
                            <div class="mb-3">
                                <div class="row">
                                    <b>{{$shopAttributeGroup->name}}</b>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6 pl-0">
                                        <span>Nhập một thuộc tính</span>
                                    </div>
                                    <div class="col-6">
                                        <span>Thêm tiền</span>
                                    </div>
                                </div>

                                <div class="list-attribute-{{$shopAttributeGroup->id}}">
                                </div>

                                <div class="row mt-3">
                                    <button type="button" class="btn btn-flat btn-success add-attribute" data-attribute-group-id="{{$shopAttributeGroup->id}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Thêm thuộc tính
                                    </button>
                                </div>
                            </div>
                        @endforeach 
                    @endif
                </div>
            </div>
            
            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.products.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/products/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/products/tinymce.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('css/admin/products/add.css')}}" rel="stylesheet" />
@endsection