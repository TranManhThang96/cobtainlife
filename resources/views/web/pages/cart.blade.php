@extends('web.layout.full')

@section('content')
<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Giỏ Hàng</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-sm-2 mr-1"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="mr-sm-2 mr-1"><a href="{{route('web.products.index')}}">Cửa Hàng</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="active">Giỏ Hàng</li>
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
                        <th scope="col" class="text-uppercase fwEbold border-top-0">Số lượng</th>
                        <th scope="col" class="text-uppercase fwEbold border-top-0">Tổng tiền</th>
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
        <div class="col-12">
            <!-- <form action="javascript:void(0);" class="cartForm mb-5">
                <div class="form-group mb-0">
                    <label for="note" class="fwEbold text-uppercase d-block mb-1">Ghi chú</label>
                    <textarea id="note" class="form-control"></textarea>
                </div>
            </form> -->
        </div>
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
        </div>
        <div class="col-12 col-md-6 text-right">
            <div class="d-flex justify-content-between">
                <strong class="txt fwEbold text-uppercase mb-1">Tiền hàng</strong>
                <strong class="price fwEbold text-uppercase mb-1" id="order-subtotal">0</strong>
            </div>
            <a href="javascript:void(0);" class="btn btnTheme w-100 fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4" id="go-checkout-confirm">Thanh Toán</a>
        </div>
    </div>
</div>
@endsection