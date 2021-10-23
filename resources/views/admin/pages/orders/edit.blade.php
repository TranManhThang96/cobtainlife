@extends('admin.layout.default')

@section('title', 'Sửa đơn hàng')

@section('breadcrumb')
{{renderBreadcrumb('Sửa đơn hàng', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách đơn hàng', 'link' => route('admin.orders.index')]
    ])}}
@endsection

@section('content')
<form id="orders-frm" method="POST" action="{{route('admin.orders.update', ['order' => $order->id])}}" name="frm-order-edit">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label for="customer-name" class="col-sm-4 text-right font-weight-bold">
                            Họ tên <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                                <input name="customer_name" type="text" value="{{old('customer_name', $order['customer_name'] ?? '')}}" class="form-control {{$errors->has('customer_name') ? 'is-invalid' : ''}}" id="order-name" />
                                <x-custom-error field="customer_name" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-phone" class="col-sm-4 text-right font-weight-bold">
                            Điện thoại <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-phone fa-fw"></i>
                                    </div>
                                </div>
                                <input name="phone" type="text" value="{{old('phone', $order['phone'] ?? '')}}" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" id="order-phone" />
                                <x-custom-error field="phone" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-email" class="col-sm-4 text-right font-weight-bold">
                            Email
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <input name="email" type="email" value="{{old('email', $order['email'] ?? '')}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="order-email" />
                                <x-custom-error field="email" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-province" class="col-sm-4 text-right font-weight-bold">
                            Tỉnh/thành <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select custom-select-2 mr-sm-2 select-province" name="province_id" id="province-id">
                                <option value="">Select a option</option>
                                @if(isset($provinces)) 
                                    @foreach($provinces as $province)
                                        <option value="{{$province['id']}}" {{old('province_id', $order['province_id'] ?? '') == $province['id'] ? 'selected' : ''}}>{{$province['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="province_id" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-name" class="col-sm-4 text-right font-weight-bold">
                            Quận Huyện <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select custom-select-2 mr-sm-2 select-district" name="district_id" id="district-id">
                                <option value="">Select a option</option>
                                @if(isset($districts)) 
                                    @foreach($districts as $district)
                                        <option value="{{$district['id']}}" {{old('district_id', $order['district_id'] ?? '') == $district['id'] ? 'selected' : ''}}>{{$district['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="district_id" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-name" class="col-sm-4 text-right font-weight-bold">
                            Xã phường <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select custom-select-2 mr-sm-2 select-district" name="ward_id" id="ward-id">
                                <option value="">Select a option</option>
                                @if(isset($wards)) 
                                    @foreach($wards as $ward)
                                        <option value="{{$ward['id']}}" {{old('ward_id', $order['ward_id'] ?? '') == $ward['id'] ? 'selected' : ''}}>{{$ward['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="ward_id" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-address" class="col-sm-4 text-right font-weight-bold">
                            Số nhà, thôn/xóm <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                                <input name="address" type="text" value="{{old('address', $order['address'] ?? '')}}" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="order-address" />
                                <x-custom-error field="address" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group row">
                        <label for="order-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái đơn hàng
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select mr-sm-2 select-status" name="status" id="order-status">
                                    @if(isset($listOrderStatus)) 
                                        @foreach($listOrderStatus as $orderStatus)
                                            <option value="{{$orderStatus['id']}}" {{old('status', $order['status'] ?? '') == $orderStatus['id'] ? 'selected' : ''}}>{{$orderStatus['name']}}</option>
                                        @endforeach 
                                    @endif
                                </select>
                                <x-custom-error field="status" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-shipping-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái vận chuyển
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select mr-sm-2 select-status" name="shipping_status" id="order-shipping-status">
                                @if(isset($listShippingStatus)) 
                                    @foreach($listShippingStatus as $shippingStatus)
                                        <option value="{{$shippingStatus['id']}}" {{old('shipping_status', $order['shipping_status'] ?? '') == $shippingStatus['id'] ? 'selected' : ''}}>{{$shippingStatus['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="shipping_status" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-payment-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái thanh toán
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select mr-sm-2 select-status" name="payment_status" id="order-payment-status">
                                @if(isset($listPaymentStatus)) 
                                    @foreach($listPaymentStatus as $paymentStatus)
                                        <option value="{{$paymentStatus['id']}}" {{old('payment_status', $order['payment_status'] ?? '') == $paymentStatus['id'] ? 'selected' : ''}}>{{$paymentStatus['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="payment_status" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-shipping-method" class="col-sm-4 text-right font-weight-bold">
                            Phương thức vận chuyển
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <select class="custom-select mr-sm-2" name="shipping_method" id="order-shipping-method">
                                    @if(isset($shippingMethods)) 
                                        @foreach($shippingMethods as $shippingMethod)
                                            <option value="{{$shippingMethod['value']}}" {{old('shipping_method', $order['shipping_method'] ?? '') == $shippingMethod['value'] ? 'selected' : ''}}>{{$shippingMethod['label']}}</option>
                                        @endforeach 
                                    @endif
                                </select>
                                <x-custom-error field="shipping_method" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-payment-method" class="col-sm-4 text-right font-weight-bold">
                            Phương thức thanh toán
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select mr-sm-2 select-status" name="payment_method" id="order-payment-method">
                                @if(isset($paymentMethods)) 
                                    @foreach($paymentMethods as $paymentMethod)
                                        <option value="{{$paymentMethod['value']}}" {{old('payment_method', $order['payment_method'] ?? '') == $paymentMethod['value'] ? 'selected' : ''}}>{{$paymentMethod['label']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="payment_method" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="order-tax-option" class="col-sm-4 text-right font-weight-bold">
                            Tiền thuế (tính theo đơn hàng)
                        </label>
                        <div class="col-sm-8">
                            <select class="custom-select mr-sm-2 select-status" name="tax_option" id="order-tax-option">
                                @if(isset($listTax)) 
                                    @foreach($listTax as $tax)
                                        <option value="{{$tax['id']}}" data-value="{{$tax['value']}}">{{$tax['name']}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            <x-custom-error field="tax_option" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row order-detail mt-5">
                <div class="col-12">
                    <div class="card collapsed-card">
                        <div class="table-responsive">
                            <table class="table table-hover box-body text-wrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>SKU</th>
                                        <th>Giá</th>
                                        <th>Thêm tiền</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="d-none" id="order-detail-hidden">
                                        <td>
                                            <select class="custom-select mr-sm-2 select-product">
                                                <option value="">Select a option</option>
                                                @if(isset($products)) 
                                                    @foreach($products as $product)
                                                        <option value="{{$product['id']}}">{{$product['name']}}</option>
                                                    @endforeach 
                                                @endif
                                            </select>
                                            <div class="product-attributes"></div>
                                            <input type="hidden" class="form-control" name="order_detail_id[#index]" value="">
                                        </td>
                                        <td>
                                            <input type="text" readonly="" class="sku form-control" name="product_sku[#index]" value="">
                                            <input type="hidden" class="form-control" value="" name="product_id[#index]">
                                            <input type="hidden" class="form-control" value="" name="product_name[#index]">
                                        </td>
                                        <td>
                                            <input min="0" class="order-detail-price form-control text-right" name="product_price[#index]" value="0" data-type='currency'>
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-control text-right" name="product_attribute[#index]">
                                            <input type="hidden" class="form-control" value="" name="product_attribute_full_id[#index]">
                                            <input min="0" readonly class="product-attribute-add-pice form-control text-right" name="product_attribute_add_pice[#index]" value="0">
                                        </td>
                                        <td>
                                            <input type="number" min="1" class="order-detail-qty form-control" name="product_qty[#index]" value="1">
                                        </td>
                                        <td>
                                            <input min="0" readonly class="product_total form-control text-right" value="0">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-md btn-flat btn-delete-order-detail" data-title="Delete">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach($order['orders'] as $key=>$orderDetail)
                                        <tr id="order-detail-{{$key}}" class="order-detail-product" data-uuid="{{$key}}">
                                            <td>
                                                <span class="mb-2">{{$orderDetail['product_name']}}</span>
                                                <div class="product-attributes">
                                                    @foreach($orderDetail['attribute'] as $attr)
                                                        <div>
                                                            <b>{{$attr['shop_attribute_group']['name']}}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                                            <span>{{$attr['name']}} (+{{number_format($attr['add_price'], 0)}})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" class="form-control" name="order_detail_id[]" value="{{$orderDetail['id']}}">
                                            </td>
                                            <td>
                                                <input type="text" readonly="" class="sku form-control" name="product_sku[]" value="{{$orderDetail['product_sku']}}">
                                                <input type="hidden" class="form-control" name="product_id[]" value="{{$orderDetail['product_id']}}">
                                                <input type="hidden" class="form-control" name="product_name[]" value="{{$orderDetail['product_name']}}">
                                            </td>
                                            <td>
                                                <input class="order-detail-price form-control text-right" name="product_price[]" value="{{number_format($orderDetail['price'], 0)}}" data-type='currency'>
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control text-right" name="product_attribute[]" value="{{json_encode($orderDetail['attribute'])}}">
                                                <input type="hidden" class="form-control" name="product_attribute_full_id[]" value="{{$orderDetail['product_full_id']}}">
                                                <input readonly class="product-attribute-add-pice form-control text-right" name="product_attribute_add_pice[]" value="{{number_format($orderDetail['total_add_price'], 0)}}">
                                            </td>
                                            <td>
                                                <input type="number" min="1" class="order-detail-qty form-control" name="product_qty[]" value="{{$orderDetail['qty']}}">
                                            </td>
                                            <td>
                                                <input readonly class="product_total form-control text-right" value="{{number_format(($orderDetail['price'] + $orderDetail['total_add_price']) * $orderDetail['qty'], 0)}}">
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-md btn-flat btn-delete-order-detail" data-title="Delete">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-custom-error field="product_id" />
                    </div>
                </div>
            </div>

            <div class="row mx-0">
                <button type="button" class="btn btn-flat btn-success" id="add-product-order" title="Thêm mới">
                    <i class="fa fa-plus"></i> Thêm mới
                </button>
            </div>

            <div class="row mx-0 mt-5">
                <div class="col-6">
                    <b>Thanh toán</b>
                    <div class="card collapsed-card">
                        <div class="table-responsive">
                            <table class="table table-hover box-body text-wrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Tiền hàng</td>
                                        <td>
                                            <input type="text" readonly class="form-control text-right" name="subtotal" value="{{number_format($order['subtotal'], 0)}}" id="order-subtotal" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thuế</td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="tax" value="{{number_format($order['tax'], 0)}}" id="order-tax" data-type='currency'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phí vận chuyển</td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="shipping" value="{{number_format($order['shipping'], 0)}}" id="order-shipping" data-type='currency'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Giảm giá</td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="discount" value="{{number_format($order['discount'], 0)}}" id="order-discount" data-type='currency'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tổng tiền</td>
                                        <td>
                                            <input type="text" readonly class="form-control text-right" name="total" value="{{number_format($order['total'], 0)}}" id="order-total" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Đã nhận</td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="received" value="{{number_format($order['received'], 0)}}" id="order-received" data-type='currency'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Còn lại</td>
                                        <td>
                                            <input type="text" readonly class="form-control text-right" name="balance" value="{{number_format($order['balance'], 0)}}" id="order-balance" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <b>Ghi chú</b>
                    <div class="card collapsed-card">
                        <textarea class="form-control" placeholder="Nhập vào ghi chú" rows="20" name="comment">{!! $order['comment'] !!}</textarea>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.orders.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success" id="btn-add-order">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/orders/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/orders/products.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('css/admin/orders/add.css')}}" rel="stylesheet" />
@endsection