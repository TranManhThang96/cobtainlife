@extends('web.layout.full')

@section('content')
    <!-- introBannerHolder -->
    <section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
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
        <div class="row view-filters mb-3 d-none">
            <div class="col-lg-10 col-md-8 col-sm-6 filter-group">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 clear-filter">
                <span id="clear-filter-button">Xóa bộ lọc</span>
            </div>
        </div>
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
                        </form>
                    </section>
                    <!-- widget -->
                    <section class="widget overflow-hidden mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-5">Danh mục</h3>
                        <ul class="list-unstyled categoryList mb-0">
                            <li class="mb-5 overflow-hidden">
                                <a href="javascript:void(0);">Cửa hàng</a>
                            </li>
                            @foreach($categories as $category)
                                @if($category->in_store)
                                    <li class="mb-5 overflow-hidden sort-category pl-5" data-id="{{$category->id}}" data-title="{{$category->title}}">
                                        <a href="javascript:void(0);">{{$category->title}} 
                                            <span class="num border float-right">{{$category->products_count ?? 0}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                            @foreach($categories as $category)
                                @if(!$category->in_store)
                                    <li class="mb-5 overflow-hidden sort-category" data-id="{{$category->id}}" data-title="{{$category->title}}">
                                        <a href="javascript:void(0);">{{$category->title}} 
                                            <span class="num border float-right">{{$category->products_count ?? 0}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">Lọc theo giá</h3>
                        <div class="filter-group filter-group-price">
                            @foreach(\App\Enums\Constant::PRICE_FILTER as $priceFilterItem)
                                <div class="filter-item" data-min="{{$priceFilterItem['min']}}" data-max="{{$priceFilterItem['max'] ?? 0}}">
                                    <span class="filter-item-label">{{$priceFilterItem['title']}}</span>
                                    <div class="filter-item-checked"></div>
                                    <span class="icon-checked">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">Độ ẩm</h3>
                        <div class="filter-group filter-group-humidity">
                            @foreach(\App\Enums\Constant::HUMIDITY as $humidityFilterItem)
                                <div class="filter-item" data-value="{{$humidityFilterItem['value']}}">
                                    <span class="filter-item-label">{{$humidityFilterItem['title']}}</span>
                                    <div class="filter-item-checked"></div>
                                    <span class="icon-checked">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </section>


                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">Ánh sáng</h3>
                        <div class="filter-group filter-group-light">
                            @foreach(\App\Enums\Constant::LIGHT as $lightFilterItem)
                                <div class="filter-item" data-value="{{$lightFilterItem['value']}}">
                                    <span class="filter-item-label">{{$lightFilterItem['title']}}</span>
                                    <div class="filter-item-checked"></div>
                                    <span class="icon-checked">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- widget -->
                    <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-6">Lượng nước</h3>
                        <div class="filter-group filter-group-water">
                            @foreach(\App\Enums\Constant::WATER as $waterFilterItem)
                                <div class="filter-item" data-value="{{$waterFilterItem['value']}}">
                                    <span class="filter-item-label">{{$waterFilterItem['title']}}</span>
                                    <div class="filter-item-checked"></div>
                                    <span class="icon-checked">✓</span>
                                </div>
                            @endforeach
                        </div>
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