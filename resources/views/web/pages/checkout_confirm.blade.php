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

@if(isset($emptyCart) && $emptyCart)
    <div class="row py-5 d-flex justify-content-center">Giỏ hàng trống!</div>
@else
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
                            <th scope="col" class="text-uppercase fwEbold border-top-0 text-center">Số lượng</th>
                            <th scope="col" class="text-uppercase fwEbold border-top-0 text-center">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        @foreach(session('cart')['cart'] as $product)
                            <tr class="align-items-center order-item">
                                <td class="border-top-0 border-bottom px-0 py-6">
                                <div class="d-flex align-items-center">
                                    <div class="imgHolder">
                                    <img src="{{asset('storage'.$product['product_image'])}}" 
                                                    alt="{{$product['product_name']}}"
                                                    onerror='this.src="{{asset('dist/images/70x80.png')}}"' 
                                                    width="70px" height="80px">
                                    </div>
                                    <span class="title pl-2">
                                        <a href="${cart[productFullId]['link']}" class="product-link" target="_blank">{{$product['product_name'] ?? ''}}</a>
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <b>Mã SKU</b><span> : {{$product['product_sku'] ?? ''}} </span><br>
                                    @if (count($product['attribute']) > 0)
                                        @foreach($product['attribute'] as $attr) 
                                            <b>{{$attr['shop_attribute_group']['name']}}</b><span class="pr-2"> : {{$attr['name']}} </span>
                                        @endforeach    
                                    @endif
                                </div>
                                </td>
                                <td class="fwEbold border-top-0 border-bottom px-0 py-6">
                                    <span class="product-price">{{number_format($product['price'], 0)}} VND</span>
                                </td>
                                <td class="border-top-0 border-bottom px-0 py-6 text-center"> 
                                    <span class="product-qty">{{$product['qty'] ?? 0}}</span>
                                </td>
                                <td class="fwEbold border-top-0 border-bottom px-0 py-6 text-center">
                                    <span class="product-total-price">{{number_format($product['price'] * $product['qty'], 0)}} VND</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table box table-bordered">
                    <tbody>
                        <tr>
                            <th>Họ và tên:</th>
                            <td>{{session('cart')['customer_name']}}</td>
                        </tr>

                        <tr>
                            <th>Điện thoại:</th>
                            <td>{{session('cart')['phone']}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{session('cart')['email']}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td>{{session('cart')['address']}}, {{$ward->prefix}} {{$ward->name}}, {{$district->prefix}} {{$district->name}}, {{$province->name}}</td>
                        </tr>

                        <tr>
                            <th>Ghi chú:</th>
                            <td>{{session('cart')['comment']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6 text-right mt-3">
                <table class="table box table-bordered" id="showTotal">
                    <tbody>
                        <tr class="showTotal">
                            <th>Tiền hàng</th>
                            <td style="text-align: right;" id="checkout-subtotal">
                                {{number_format(session('cart')['subTotal'], 0)}}
                            </td>
                        </tr>
                        <tr class="showTotal">
                            <th>Thuế</th>
                            <td style="text-align: right;" id="checkout-tax">
                                {{session('cart')['tax']}}
                            </td>
                        </tr>
                        <tr class="showTotal" style="background: #f5f3f3; font-weight: bold;">
                            <th>Tổng tiền</th>
                            <td style="text-align: right;" id="checkout-total">
                                {{number_format(session('cart')['totalPrice'], 0)}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{route('web.cart.index')}}" class="btn btn-secondary fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">
                        <i class="fa fa-arrow-left"></i> Trở lại giỏ hàng
                    </a>
                    <a href="javascript:void(0);" class="btn btnTheme fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4 ml-2" 
                        id="checkout-confirm-submit-order">
                        <i class="fa fa-check"></i> Xác nhận
                    </a>
                </div> 
                
            </div>
        </div>
    </div>
@endif

@endsection

@section('script')
<script src="{{asset('js/web/checkout.js')}}" rel="stylesheet"></script>
@endsection