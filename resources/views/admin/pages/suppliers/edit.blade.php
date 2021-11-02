@extends('admin.layout.default')

@section('title', 'Sửa nhà cung cấp')

@section('breadcrumb')
{{renderBreadcrumb('Sửa nhà cung cấp', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách nhà cung cấp', 'link' => route('admin.suppliers.index')]
    ])}}
@endsection

@section('content')
<form id="supplier-frm" method="POST" action="{{route('admin.suppliers.update', ['supplier' => $supplier->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$supplier->id}}"/>
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="supplier-title" class="col-sm-2 text-right font-weight-bold">
                    Tên nhà cung cấp <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <input name="name" type="text" value="{{old('name') ?? $supplier->name}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="supplier-name" />
                    <x-custom-error field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-phone" class="col-sm-2 text-right font-weight-bold">Số điện thoại</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-phone fa-fw"></i>
                            </div>
                        </div>
                        <input name="phone" type="text" value="{{old('phone') ?? $supplier->phone}}" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" id="supplier-phone" />
                        <x-custom-error field="phone" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-url" class="col-sm-2 text-right font-weight-bold">Website</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                        </div>
                        <input name="url" type="text" value="{{old('url') ?? $supplier->url}}" class="form-control {{$errors->has('url') ? 'is-invalid' : ''}}" id="supplier-url" />
                        <x-custom-error field="url" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-email" class="col-sm-2 text-right font-weight-bold">Email</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input name="email" type="email" value="{{old('email') ?? $supplier->email}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="supplier-email" />
                        <x-custom-error field="email" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-address" class="col-sm-2 text-right font-weight-bold">Địa chỉ</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="address" type="text" value="{{old('address') ?? $supplier->address}}" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="supplier-address" />
                        <x-custom-error field="address" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-sort" class="col-sm-2 text-right font-weight-bold">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort') ?? $supplier->sort}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="supplier-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="supplier-description" class="col-sm-2 text-right font-weight-bold">Hình ảnh</label>
                <div class="col-sm-10">
                    <div id="supplier-image">
                        <input name="image" id="image-input" value="{{old('image', $supplier->image)}}" type="hidden" />
                        <img id="image-preview" src="{{old('image', $supplier->image) ? asset('storage'.old('image', $supplier->image)) : asset('assets/images/no-image.png')}}" alt="no-image" />
                        <div id="supplier-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="image" />
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.suppliers.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/suppliers/add.js')}}"></script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('css/admin/suppliers/add.css')}}" rel="stylesheet" />
@endsection