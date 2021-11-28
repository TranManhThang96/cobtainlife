@extends('web.layout.full')

@section('content')
<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Giỏ Hàng</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-sm-2 mr-1"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="mr-sm-2 mr-1"><a href="{{route('web.products.index')}}">Cửa Hàng</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="active">Thanh Toán</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- cartHolder -->
<div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
    <div class="row">
        <!-- table-responsive -->
        <div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
            <!-- cartTable -->
            <table class="table cartTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-uppercase fwEbold border-top-0">Sản phẩm</th>
                        <th scope="col" class="text-uppercase fwEbold border-top-0">Giá</th>
                        <th scope="col" class="text-uppercase fwEbold border-top-0 {{request()->route()->getName() == 'web.checkout.index' ? 'text-center' : ''}}">Số lượng</th>
                        <th scope="col" class="text-uppercase fwEbold border-top-0 {{request()->route()->getName() == 'web.checkout.index' ? 'text-center' : ''}}">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <tr class="align-items-center order-item">
                        <td colspan="4" class="text-center mt-5">Giỏ hàng trống</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <!-- <form action="javascript:void(0);" class="couponForm mb-md-0 mb-5">
                <fieldset>
                    <div class="mt-holder d-inline-block align-bottom mr-lg-5 mr-0 mb-lg-0 mb-2">
                        <label for="code" class="fwEbold text-uppercase d-block mb-1">promo code</label>
                        <input type="text" id="code" class="form-control">
                    </div>
                    <button type="submit" class="btn btnTheme btnCart fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">Apply</button>
                </fieldset>
            </form> -->
            <form id="frm-order-info">
                <table class="table table-borderless table-responsive">

                    <tbody>
                        <tr width="100%">
                            <td class="form-group" colspan="2">
                                <label class="control-label font-weight-bold text-center">Thông tin giao hàng</label>
                            </td>
                        </tr>
                        <tr width="100%">
                            <td class="form-group" colspan="2">
                                <label for="phone" class="control-label"><i class="fa fa-user"></i> Họ và Tên:</label>
                                <input class="form-control" name="customer_name" type="text" placeholder="Họ và Tên" value="" />
                            </td>
                        </tr>

                        <tr>
                            @csrf
                            <td class="form-group">
                                <label for="email" class="control-label"><i class="fa fa-envelope"></i> Email:</label>
                                <input class="form-control" name="email" type="email" placeholder="Email" value="" />
                            </td>
                            <td class="form-group">
                                <label for="phone" class="control-label"><i class="fa fa-phone" aria-hidden="true"></i> Điện thoại:</label>
                                <input class="form-control" name="phone" type="text" placeholder="Điện thoại" value="" />
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="form-group">
                                <label for="address1" class="control-label"><i class="fa fa-list-ul"></i> Tỉnh/Thành:</label>
                                <select class="custom-select custom-select-2 mr-sm-2 select-province" name="province_id" id="province-id">
                                    <option value="">Tỉnh/Thành</option>
                                    @if(isset($provinces))
                                    @foreach($provinces as $province)
                                    <option value="{{$province['id']}}">{{$province['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="form-group">
                                <label for="address2" class="control-label"><i class="fa fa-list-ul"></i> Quận/huyện:</label>
                                <select class="custom-select custom-select-2 mr-sm-2 select-district" name="district_id" id="district-id">
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="form-group">
                                <label for="address2" class="control-label"><i class="fa fa-list-ul"></i> Xã/phường:</label>
                                <select class="custom-select custom-select-2 mr-sm-2 select-district" name="ward_id" id="ward-id">
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <label class="control-label"><i class="fa fa-calendar-o"></i> Địa chỉ:</label>
                                <textarea class="form-control" rows="2" name="address" placeholder="Thôn/xóm/số nhà/ngõ/ngách/đường...."></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <label class="control-label"><i class="fa fa-calendar-o"></i> Ghi chú:</label>
                                <textarea class="form-control" rows="5" name="comment" placeholder="Ghi chú...."></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>

        <div class="col-12 col-md-6 text-right mt-3">
            <div class="row mb-3 text-left d-flex align-items-center">
                <div class="col-6">
                    <input class="form-control" name="coupon_code" type="text" placeholder="Mã giảm giá" value="" />
                </div>
                <div class="col-6">
                    <button class="btn btnTheme w-100 fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4" id="button-apply-coupon">Áp dụng</button>
                </div>
            </div>

            <table class="table box table-bordered" id="showTotal">
                <tbody>
                    <tr class="showTotal">
                        <th>Tiền hàng</th>
                        <td style="text-align: right;" id="checkout-subtotal">
                            0
                        </td>
                    </tr>
                    <tr class="showTotal">
                        <th>Thuế
                            @if (isset($configs->order_default_vat))
                                ({{$configs->order_default_vat['value']}}%)
                            @endif
                        </th>
                        <td style="text-align: right;" id="checkout-tax" data-vat="{{$configs->order_default_vat['value'] ?? 0}}">
                            0
                        </td>
                    </tr>
                    <tr class="showTotal">
                        <th>Mã giảm giá</th>
                        <td style="text-align: right;" id="checkout-coupon">
                            
                        </td>
                    </tr>
                    <tr class="showTotal">
                        <th>Giảm giá</th>
                        <td style="text-align: right;" id="checkout-discount">
                            0
                        </td>
                    </tr>
                    <tr class="showTotal" style="background: #f5f3f3; font-weight: bold;">
                        <th>Tổng tiền</th>
                        <td style="text-align: right;" id="checkout-total">
                            0
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-5">
                <strong class="txt fwEbold text-uppercase mb-1">Tổng tiền</strong>
                <strong class="price fwEbold text-uppercase mb-1" id="order-subtotal">0</strong>
            </div>
            <a href="javascript:void(0);" class="btn btnTheme w-100 fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4" id="button-payment-process">Thanh Toán</a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/web/checkout.js')}}" rel="stylesheet"></script>
@endsection