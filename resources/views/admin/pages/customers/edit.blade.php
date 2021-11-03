@extends('admin.layout.default')

@section('title', 'Sửa khách hàng')

@section('breadcrumb')
{{renderBreadcrumb('Sửa khách hàng', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách khách hàng', 'link' => route('admin.customers.index')]
    ])}}
@endsection

@section('content')
<form id="customers-frm" method="POST" action="{{route('admin.customers.update', ['customer' => $customer->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$customer->id}}" />
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="customer-url" class="col-sm-2 text-right font-weight-bold">
                    Tên khách hàng <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input name="name" type="text" value="{{old('name', $customer->name) ?? ''}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="customer-name" />
                        <x-custom-error field="name" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-phone" class="col-sm-2 text-right font-weight-bold">
                    Số điện thoại <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-phone fa-fw"></i>
                            </div>
                        </div>
                        <input name="phone" type="text" value="{{old('phone', $customer->phone) ?? ''}}" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" id="customer-phone" />
                        <x-custom-error field="phone" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-email" class="col-sm-2 text-right font-weight-bold">Email</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input name="email" type="email" value="{{old('email', $customer->email) ?? ''}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="customer-email" />
                        <x-custom-error field="email" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-province" class="col-sm-2 text-right font-weight-bold">
                    Tỉnh/thành
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-province" name="province_id" id="province-id">
                        <option value="">Select a option</option>
                        @if(isset($provinces))
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}" {{old('province_id', $customer->province_id ?? '') == $province->id ? 'selected' : ''}}>{{$province->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <x-custom-error field="province_id" />
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-name" class="col-sm-2 text-right font-weight-bold">
                    Quận Huyện
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-district" name="district_id" id="district-id">
                        <option value="">Select a option</option>
                        @if(isset($districts))
                        @foreach($districts as $district)
                        <option value="{{$district->id}}" {{old('district_id', $customer->district_id ?? '') == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <x-custom-error field="district_id" />
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-name" class="col-sm-2 text-right font-weight-bold">
                    Xã phường
                </label>
                <div class="col-sm-10">
                    <select class="custom-select custom-select-2 mr-sm-2 select-district" name="ward_id" id="ward-id">
                        <option value="">Select a option</option>
                        @if(isset($wards))
                        @foreach($wards as $ward)
                        <option value="{{$ward->id}}" {{old('ward_id', $customer->ward_id ?? '') == $ward->id ? 'selected' : ''}}>{{$ward->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <x-custom-error field="ward_id" />
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-address" class="col-sm-2 text-right font-weight-bold">
                    Số nhà, thôn/xóm
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="address" type="text" value="{{old('address', $customer->address) ?? ''}}" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="customer-address" />
                        <x-custom-error field="address" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-name" class="col-sm-2 text-right font-weight-bold">
                    Giới tính
                </label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="1" {{$customer->sex == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="male">
                            Nam
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="2" {{$customer->sex == '2' ? 'checked' : ''}}>
                        <label class="form-check-label" for="female">
                            Nữ
                        </label>
                    </div>
                    <x-custom-error field="sex" />
                </div>
            </div>

            <div class="form-group row">
                <label for="customer-email" class="col-sm-2 text-right font-weight-bold">Mật khẩu</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <input name="password" type="text" value="" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="customer-password" />
                        <x-custom-error field="password" />
                    </div>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label for="customer-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="customer-status" checked>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div> -->

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.customers.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/admin/customers/add.js')}}"></script>
@endsection

@section('css')
<link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<link type="text/css" href="{{asset('css/admin/customers/add.css')}}" rel="stylesheet" />
@endsection