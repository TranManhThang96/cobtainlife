@extends('admin.layout.default')

@section('title', 'Chi tiết đơn hàng')

@section('breadcrumb')
{{renderBreadcrumb('Chi tiết đơn hàng', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách đơn hàng', 'link' => route('admin.orders.index')]
    ])}}
@endsection

@section('content')
<div>
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
                            <span>{{$order['customer_name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-phone" class="col-sm-4 text-right font-weight-bold">
                            Điện thoại <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['phone']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-email" class="col-sm-4 text-right font-weight-bold">
                            Email
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['email']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-province" class="col-sm-4 text-right font-weight-bold">
                            Tỉnh/thành <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['province']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-name" class="col-sm-4 text-right font-weight-bold">
                            Quận Huyện <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['district']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-name" class="col-sm-4 text-right font-weight-bold">
                            Xã phường <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['ward']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-address" class="col-sm-4 text-right font-weight-bold">
                            Số nhà, thôn/xóm <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['address']}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group row">
                        <label for="order-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái đơn hàng
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['orderStatus']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-shipping-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái vận chuyển
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['shippingStatus']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-payment-status" class="col-sm-4 text-right font-weight-bold">
                            Trạng thái thanh toán
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['paymentStatus']['name']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-shipping-method" class="col-sm-4 text-right font-weight-bold">
                            Phương thức vận chuyển
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['shipping_method']}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order-payment-method" class="col-sm-4 text-right font-weight-bold">
                            Phương thức thanh toán
                        </label>
                        <div class="col-sm-8">
                            <span>{{$order['payment_method']}}</span>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order['orders'] as $product)
                                        <tr>
                                            <td>
                                                <span>{{$product['product_name']}}</span>
                                                <div class="product-attributes">
                                                    @foreach($product['attribute'] as $attr)
                                                        <div>
                                                            <b>{{$attr['shop_attribute_group']['name']}}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                                            <span>{{$attr['name']}} (+{{number_format($attr['add_price'], 0)}})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <span>{{$product['product_sku']}}</span>
                                            </td>
                                            <td class="text-right">
                                                <span>{{number_format($product['price'], 0)}}</span>
                                            </td>
                                            <td  class="text-right">
                                                <span>{{number_format($product['total_add_price'], 0)}}</span>
                                            </td>
                                            <td>
                                                <span>{{$product['qty']}}</span>
                                            </td>
                                            <td  class="text-right"> 
                                                <span>{{number_format(($product['price'] + $product['total_add_price']) * $product['qty'], 0)}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                        <td class="text-right">
                                            <span>{{number_format($order['subtotal'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thuế</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['tax'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phí vận chuyển</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['shipping'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Giảm giá</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['discount'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tổng tiền</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['total'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Đã nhận</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['received'], 0)}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Còn lại</td>
                                        <td class="text-right">
                                            <span>{{number_format($order['balance'], 0)}}</span>
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
        </div>
    </div>
</div>
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