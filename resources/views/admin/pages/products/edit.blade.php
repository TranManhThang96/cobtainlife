@extends('admin.layout.default')

@section('title', 'Sửa sản phẩm')

@section('breadcrumb')
{{renderBreadcrumb('Sửa sản phẩm', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách sản phẩm', 'link' => route('admin.products.index')]
    ])}}
@endsection

@section('content')
<form id="products-frm" method="POST" action="{{route('admin.products.update',  ['product' => $product->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$product->id}}"/>
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 text-right font-weight-bold">
                    Tên <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <input name="name" type="text" value="{{old('name') ?? $product->name}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="product-name" />
                    <x-custom-error field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="product-description" class="col-sm-2 text-right font-weight-bold">Mô tả</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="product-description" rows="3" name="description">{{old('description') ?? $product->description}}</textarea>
                    <x-custom-error field="description" />
                </div>
            </div>

            <div class="form-group row">
                <label for="editor_content" class="col-sm-2 text-right font-weight-bold">
                    Nội dung chính <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                        <textarea id="editor_content" name="content" rows="30"
                                  class="{{$errors->has('content') ? 'invalid-border' : ''}}">{!! old('content') ?? $product->content !!}</textarea>
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
                                <option value="{{$category['id']}}" {{old('category_id', $product->category_id) == $category['id'] ? 'selected' : ''}}>{{$category['label']}}</option>
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
                                <input type="text" name="image" class="form-control" id="product-image" value='{{old('image', $product->image)}}'>
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="product-image" data-preview="preview-image" data-type="product">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <x-custom-error field="image"/>

                        @if($product->image)
                            <div id="preview-image" class="img-holder mt-3">
                                <img src="{{asset('storage'.$product->image)}}">
                            </div>
                        @endif
                    </div>    

                    <!-- sub images -->
                    <div class="group-image">
                        @if($product->images)
                            @foreach($product->images as $img)
                                <div class="row sub-image mx-0 mt-3 image-product">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="text" name="sub_images[]" class="form-control" id="{{'sub-image-'.$img['id']}}" value="{{$img['image']}}"/>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="btn btn-primary lfm" data-input="{{'sub-image-'.$img['id']}}" data-preview="{{'preview-sub-image-'.$img['id']}}" data-type="product"> <i class="fas fa-image"></i> Chọn hình </span>
                                            <span title="Remove" class="btn btn-flat btn-danger remove-sub-image"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>

                                    <div id="preview-image" class="img-holder mt-3">
                                        <img src="{{asset('storage'.$img['image'])}}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        <input name="sku" type="text" value="{{old('sku') ?? $product->sku}}" class="form-control {{$errors->has('sku') ? 'is-invalid' : ''}}" id="product-sku" />
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
                                {{(old('humidity') ?? $product->humidity) == $humidityItem['value'] ? 'checked' : ''}} 
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
                                {{(old('light') ?? $product->light) == $lightItem['value'] ? 'checked' : ''}} 
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
                                {{(old('water') ?? $product->water) == $waterItem['value'] ? 'checked' : ''}} 
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
                                <option value="{{$brand['id']}}" {{old('brand_id', $product->brand_id) == $brand['id'] ? 'selected' : ''}}>{{$brand['name']}}</option>
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
                                <option value="{{$supplier['id']}}" {{old('supplier_id', $product->supplier_id) == $supplier['id'] ? 'selected' : ''}}>{{$supplier['name']}}</option>
                            @endforeach 
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-cost" class="col-sm-2 text-right font-weight-bold">Giá cost</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="cost" value="{{old('cost') ?? number_format($product->cost, 0)}}" class="form-control {{$errors->has('cost') ? 'is-invalid' : ''}}" id="product-cost" data-type='currency'/>
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
                        <input name="price" value="{{old('price') ?? number_format($product->price, 0)}}" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" id="product-price" data-type='currency'/>
                        <x-custom-error field="price" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="add-product-promotion" class="col-sm-2 text-right font-weight-bold">Giá khuyến mãi</label>
                <div class="col-sm-10">
                    @if (isset($product['promotion']))
                    <div class="price_promotion">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                            </div>
                            <input id="price-promotion" name="price_promotion" value="{{number_format($product['promotion']['price_promotion'], 0)}}" class="form-control input-sm price" placeholder="" data-type='currency'/>
                            <span title="Remove" class="btn btn-flat btn-danger remove-promotion" id="remove-product-promotion">
                                <i class="fa fa-times"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="mt-3">Ngày bắt đầu</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
                                </div>
                                <input
                                    type="text"
                                    style="width: 150px;"
                                    id="price-promotion-start"
                                    name="price_promotion_start"
                                    value="{{$product['promotion']['start'] ? date('d/m/Y', strtotime($product['promotion']['start'])) : ''}}"
                                    class="form-control input-sm price-promotion-start date-time datepicker"
                                    data-date-format="dd/mm/yyyy"
                                    placeholder="dd/mm/yyyy"
                                />
                            </div>

                            <label class="mt-3">Ngày kết thúc</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
                                </div>
                                <input
                                    type="text"
                                    style="width: 150px;"
                                    id="price-promotion-end"
                                    name="price_promotion_end"
                                    value="{{$product['promotion']['end'] ? date('d/m/Y', strtotime($product['promotion']['end'])) : ''}}"
                                    class="form-control input-sm price-promotion-end date-time datepicker"
                                    data-date-format="dd/mm/yyyy"
                                    placeholder="dd/mm/yyyy"
                                />
                            </div>
                        </div>
                    </div>

                    @else
                        <button type="button" id="add-product-promotion" class="btn btn-flat btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm giá khuyến mãi
                        </button>
                    @endif
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
                        <input name="stock" type="number" value="{{old('stock') ?? $product->stock}}" class="form-control {{$errors->has('stock') ? 'is-invalid' : ''}}" id="product-stock" />
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
                            <option selected value="">Chọn đơn vị khối lượng</option>
                            @if(isset($weightClasses)) 
                                @foreach($weightClasses as $weightClass)
                                    <option value="{{$weightClass['name']}}" {{old('weight_class', $product->weight_class) == $weightClass['name'] ? 'selected' : ''}}>{{$weightClass['description']}}</option>
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
                        <input name="weight" type="number" value="{{old('weight') ?? $product->weight}}" class="form-control {{$errors->has('weight') ? 'is-invalid' : ''}}" id="product-weight" />
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
                                <option value="{{$lengthClass['name']}}" {{old('length_class', $product->length_class) == $lengthClass['name'] ? 'selected' : ''}}>{{$lengthClass['description']}}</option>
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
                        <input name="length" type="number" value="{{old('length') ?? $product->length}}" class="form-control {{$errors->has('length') ? 'is-invalid' : ''}}" id="product-length" />
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
                        <input name="height" type="number" value="{{old('height') ?? $product->height}}" class="form-control {{$errors->has('height') ? 'is-invalid' : ''}}" id="product-height" />
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
                        <input name="width" type="number" value="{{old('width') ?? $product->width}}" class="form-control {{$errors->has('width') ? 'is-invalid' : ''}}" id="product-width" />
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
                        <input name="sort" type="number" value="{{old('sort') ?? $product->sort}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="product-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="product-status" {{(old('status') ?? $product->status) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-new-arrival" class="col-sm-2 text-right font-weight-bold">Sản phẩm mới về</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="new_arrival" value="1" id="product-new-arrival" {{(old('status') ?? $product->new_arrival) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product-hot" class="col-sm-2 text-right font-weight-bold">Sản phẩm hot</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="hot" value="1" id="product-hot" {{(old('status') ?? $product->hot) == '1' ? 'checked' : ''}}>
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
                                    @if (isset($product['attributes']))
                                        @foreach($product['attributes'] as $attribute)
                                            @if ($attribute['attribute_group_id'] == $shopAttributeGroup->id)
                                                <div class="row attribute-item mt-3">
                                                    <div class="col-6 pl-0">
                                                        <input type="text" name="{{'attributes['.$attribute['attribute_group_id'].'][name][]'}}" value="{{$attribute['name']}}" class="form-control rounded-0 input-sm" placeholder="Nhập một thuộc tính" />
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                        <input type="text" name="{{'attributes['.$attribute['attribute_group_id'].'][add_price][]'}}" value="{{number_format($attribute['add_price'], 0)}}" class="form-control rounded-0 input-sm" placeholder="Thêm tiền" data-type="currency" />
                                                        <span title="Remove" class="btn btn-flat btn-danger remove-attribute">
                                                            <i class="fa fa-times"></i>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
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