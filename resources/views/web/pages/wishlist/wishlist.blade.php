@extends('web.layout.default')

@section('content')
    <!-- introBannerHolder -->
    <section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{asset('dist/images/1920x300.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                    <h1 class="headingIV fwEbold playfair mb-4">Sản phẩm yêu thích</h1>
                    <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                        <li class="mr-sm-2 mr-1"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                        <li class="mr-sm-2 mr-1">/</li>
                        <li class="mr-sm-2 mr-1"><a href="{{route('web.products.index')}}">Cửa Hàng</a></li>
                        <li class="mr-sm-2 mr-1">/</li>
                        <li class="active">Sản phẩm yêu thích</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- twoColumns -->
    <div class="twoColumns container pt-lg-23 pb-lg-20 pt-md-16 pb-md-4 pt-10 pb-4">
        <div class="row">
            <div class="col-12 col-lg-9 order-lg-3" id="product-render-data">
                <!-- content -->
                <div class="row mt-5">
                    <span class="text-danger">Không tìm thấy dữ liệu</span>
                </div>
            </div>
            <div class="col-12 col-lg-3 order-lg-1">
                <!-- sidebar -->
                <aside id="sidebar">
                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">xem nhiều</h3>
                        <ul class="list-unstyled recentListHolder mb-0 overflow-hidden">
                            @foreach($productsMostViews as $product)
                                <li class="mb-6 d-flex flex-nowrap">
                                    <div class="alignleft">
                                        <a href="{{route('web.products.show', ['product' => $product->alias])}}">
                                            <img src="{{asset('storage'.$product->image)}}" 
                                                alt="{{$product->name}}"
                                                onerror='this.src="{{asset('dist/images/70x80.png')}}"' 
                                                width="70px" height="80px">
                                        </a>
                                    </div>
                                    <div class="description-wrap pl-1">
                                        <h4 class="headingVII mb-1"><a href="{{route('web.products.show', ['product' => $product->alias])}}">{{$product->name}}</a></h4>
                                        @if($product->promotionValid)
                                            <span class="price d-block pb-1"><del>{{number_format($product->price, 0)}} VND</del></span>
                                            <span class="price d-block fwEbold">{{number_format($product->promotion->price_promotion, 0)}} VND</span>
                                        @else
                                            <strong class="price fwEbold d-block;">{{number_format($product->price, 0)}} VND</strong>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-5">tags</h3>
                        <ul class="list-unstyled tagNavList d-flex flex-wrap mb-0">
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Plant</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Floor</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Indoor</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Green</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Healthy</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Cactus</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">House plant</a></li>
                            <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Office tree</a></li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
    <div class="container mb-lg-24 mb-md-16 mb-10">
        <!-- subscribeSecBlock -->
        <section class="subscribeSecBlock bgCover col-12 pt-lg-24 pb-lg-12 pt-md-16 pb-md-8 py-10" style="background-image: url({{asset('dist/images/1170x465.png')}})">
            <header class="col-12 mainHeader mb-9 text-center">
                <h1 class="headingIV playfair fwEblod mb-4">Subscribe Our Newsletter</h1>
                <span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
                <p class="mb-6">Enter Your email address to join our mailing list and keep yourself update</p>
            </header>
            <form class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
                <input type="email" class="form-control px-4 border-0" placeholder="Enter your mail...">
                <button type="submit" class="btn btnTheme btnShop fwEbold text-white py-3 px-4 py-md-3 px-md-4">Shop Now <i class="fas fa-arrow-right ml-2"></i></button>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/web/wishlist.js')}}" rel="stylesheet"></script>
@endsection

@section('css')
    <link href="{{asset('css/web/wishlist/products.css')}}" rel="stylesheet"></link>
@endsection