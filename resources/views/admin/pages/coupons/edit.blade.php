@extends('admin.layout.default')

@section('title', 'Sửa mã giảm giá')

@section('breadcrumb')
{{renderBreadcrumb('Sửa mã giảm giá', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách mã giảm giá', 'link' => route('admin.coupons.index')]
    ])}}
@endsection

@section('content')
<form id="coupons-frm" method="POST" action="{{route('admin.coupons.update', ['coupon' => $coupon->id])}}">
    @method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$coupon->id}}" />
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="coupon-name" class="col-sm-2 text-right font-weight-bold">
                    Tên mã giảm giá <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="name" type="text" value="{{old('name', $coupon->name)}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="coupon-name" />
                    </div>
                    <x-custom-error field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="coupon-value" class="col-sm-2 text-right font-weight-bold">
                    Giá trị <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="value" type="number" max="100" value="{{old('value', $coupon->value)}}" class="form-control {{$errors->has('value') ? 'is-invalid' : ''}}" id="coupon-value" />
                    </div>
                    <small class="form-text text-muted">Phần trăm đơn hàng</small>
                    <x-custom-error field="value" />
                </div>
            </div>

            <div class="form-group row">
                <label for="coupon-max-discount" class="col-sm-2 text-right font-weight-bold">
                    Giá giá tối đa <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="max_discount" type="text" value="{{old('max_discount', number_format($coupon->max_discount, 0))}}" class="form-control {{$errors->has('max_discount') ? 'is-invalid' : ''}}" id="coupon-max-discount" data-type="currency" />
                    </div>
                    <small class="form-text text-muted">Tối đa bao nhiêu tiền.</small>
                    <x-custom-error field="max_discount" />
                </div>
            </div>

            <div class="form-group row">
                <label for="coupon-max-applied" class="col-sm-2 text-right font-weight-bold">
                    Số lượt tối đa áp dụng <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="max_applied" type="number" value="{{old('max_applied', $coupon->max_applied)}}" class="form-control {{$errors->has('max_applied') ? 'is-invalid' : ''}}" id="coupon-max-applied" />
                    </div>
                    <small class="form-text text-muted">Tối đao bao nhiêu lượt. Nếu quá số lượt thì mã không được áp dụng</small>
                    <x-custom-error field="max_applied" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right font-weight-bold">Ngày bắt đầu</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                        <input
                            type="text"
                            style="width: 150px;"
                            id="coupon-start"
                            name="start"
                            value="{{$coupon->start ? date('d/m/Y', strtotime($coupon->start)) : ''}}"
                            class="form-control input-sm coupon-start date-time datepicker"
                            data-date-format="dd/mm/yyyy"
                            placeholder="dd/mm/yyyy"
                        />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right font-weight-bold">Ngày kết thúc</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                        <input type="text" 
                            style="width: 150px;" 
                            id="coupon-end" 
                            name="end" 
                            value="{{$coupon->end ? date('d/m/Y', strtotime($coupon->end)) : ''}}"
                            class="form-control input-sm coupon-end date-time datepicker" 
                            data-date-format="dd/mm/yyyy" 
                            placeholder="dd/mm/yyyy"
                        />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="coupon-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="coupon-status" {{(old('status') ?? $coupon->status) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.coupons.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/coupons/add.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
@endsection