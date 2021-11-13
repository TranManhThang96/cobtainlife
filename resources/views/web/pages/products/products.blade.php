@extends('web.layout.full')

@section('content')
    <!-- introBannerHolder -->
    <section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{asset('dist/images/1920x300.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                    <h1 class="headingIV fwEbold playfair mb-4">Cửa Hàng</h1>
                    <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                        <li class="mr-2"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                        <li class="mr-2">/</li>
                        <li class="active">Cửa Hàng</li>
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
                @include('web.pages.products.list')
            </div>
            <div class="col-12 col-lg-3 order-lg-1">
                <!-- sidebar -->
                <aside id="sidebar">
                    <!-- widget -->
                    <section class="widget overflow-hidden mb-9">
                        <form action="javascript:void(0);" class="searchForm position-relative border" id="frm-search">
                            <fieldset>
                                <input type="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." name="q" id="frm-search-query">
                                <button class="position-absolute" id="btn-search-product"><i class="icon-search"></i></button>
                            </fieldset>
                            <input type="hidden" name="sort_by" value="" id="frm-search-sort-by"/>
                            <input type="hidden" name="order_by" value="" id="frm-search-order-by"/>
                            <input type="hidden" name="page" value="1" id="frm-search-page"/>
                            <input type="hidden" name="category_id" value="" id="frm-search-category-id"/>
                            <input type="hidden" name="price_from" value="" id="frm-search-price-from"/>
                            <input type="hidden" name="price_to" value="" id="frm-search-price-to"/>
                        </form>
                    </section>
                    <!-- widget -->
                    <section class="widget overflow-hidden mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-5">Danh mục</h3>
                        <ul class="list-unstyled categoryList mb-0">
                            @foreach($categories as $category)
                                <li class="mb-5 overflow-hidden sort-category" data-id="{{$category->id}}">
                                    <a href="javascript:void(0);">{{$category->title}} 
                                        <span class="num border float-right">{{$category->products_count ?? 0}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">Lọc theo giá</h3>
                        <!-- filter ranger form -->
                        <form action="javascript:void(0);" class="filter-ranger-form">
                            <div id="slider-range"></div>
                            <input type="hidden" id="amount1" name="amount1">
                            <input type="hidden" id="amount2" name="amount2">
                            <div class="get-results-wrap d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btnTheme btn-shop fwEbold md-round px-3 pt-1 pb-2 text-uppercase" id="btn-filter-price">Lọc</button>
                                <p id="amount" class="mb-0"></p>
                            </div>
                        </form>
                    </section>
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
    <script src="{{asset('js/web/products/index.js')}}" rel="stylesheet"></script>
@endsection

@section('css')
    <link href="{{asset('css/web/products/index.css')}}" rel="stylesheet"></link>
@endsection