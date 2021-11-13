@extends('web.layout.full')

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
@endsection

@section('script')
    <script src="{{asset('js/web/wishlist.js')}}" rel="stylesheet"></script>
@endsection

@section('css')
    <link href="{{asset('css/web/wishlist/products.css')}}" rel="stylesheet"></link>
@endsection