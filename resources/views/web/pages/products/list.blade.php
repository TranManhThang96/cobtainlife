<article id="content">
    <!-- show-head -->
    <header class="show-head d-flex flex-wrap justify-content-between mb-7">
        <ul class="list-unstyled viewFilterLinks d-flex flex-nowrap align-items-center">
            <li class="mr-2">
                Hiển thị {{$products->total() > ($products->currentPage() - 1) * $products->perPage() ? ($products->currentPage() - 1) * $products->perPage() + 1 : 0}} -
                {{$products->total() < ($products->currentPage() - 1) * $products->perPage() + $products->perPage() ? $products->total() : ($products->currentPage() - 1) * $products->perPage() + $products->perPage()}}
                của
                {{$products->total()}} kết quả
            </li>
        </ul>
        <!-- sortGroup -->
        <div class="sortGroup">
            <div class="d-flex flex-nowrap align-items-center">
                <strong class="groupTitle mr-2">Lọc theo:</strong>
                <div class="dropdown">
                    <button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{request()->sort_by == 'price' ? (request()->order_by == 'desc' ? 'Giá giảm dần' : 'Giá tăng dần') : 'Xem nhiều'}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
                        <div data-sort="view-desc" class="sort-option"><a>Xem nhiều</a></div>
                        <div data-sort="price-asc" class="sort-option"><a>Giá tăng dần</a></div>
                        <div data-sort="price-desc" class="sort-option"><a>Giá giảm dần</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="row">
        @foreach($products as $product)
        <!-- featureCol -->
        <!-- class="img-fluid w-100" bo class cua image -->
        <div class="col-12 col-sm-6 col-lg-4 featureCol mb-7">
            <div class="border">
                <div class="imgHolder position-relative w-100 overflow-hidden">
                    <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/70x300.png')}}"' width="270px" height="300px">
                    <ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
                        <li class="mr-2 overflow-hidden add-wishlist" data-product-id="{{$product->id}}"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
                        <li class="mr-2 overflow-hidden">
                            @if ($product->attributes_count > 0)
                                <a href="{{route('web.products.show', ['product' => $product->alias])}}" class="icon-cart d-block"></a>
                            @else
                                <a href="javascript:void(0);" class="icon-cart d-block add-to-cart" 
                                data-product-id="{{$product->id}}"
                                data-product-name="{{$product->name}}"
                                data-product-link="{{route('web.products.show', ['product' => $product->alias])}}"
                                data-product-sku="{{$product->sku}}"
                                data-product-full-id="{{$product->id}}"
                                data-product-image="{{asset('storage'.$product->image)}}"
                                data-product-price="{{$product->promotionValid ? $product->promotion->price_promotion : $product->price}}"
                                >
                            </a>
                            @endif
                        </li>
                        <li class="mr-2 overflow-hidden"><a href="{{route('web.products.show', ['product' => $product->alias])}}" class="icon-eye d-block"></a></li>
                        <li class="overflow-hidden add-compare-list" data-product-id="{{$product->id}}"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
                    </ul>
                </div>
                <div class="text-center py-5 px-4">
                    <span class="title d-block mb-2"><a href="{{route('web.products.show', ['product' => $product->alias])}}">{{$product->name}}</a></span>
                    @if($product->promotionValid)
                        <span class="price d-block fwEbold"><del>{{number_format($product->price, 0)}} VND</del>{{number_format($product->promotion->price_promotion, 0)}} VND</span>
                    @else
                        <span class="price d-block fwEbold">{{number_format($product->price, 0)}} VND</span>
                    @endif

                    @if($product->hot)
                        <span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block {{$product->promotionValid ? 'ml-8' : ''}}">HOT</span>
                    @endif

                    @if($product->promotionValid)
                        <span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3">
            {{$products->links('vendor.pagination.cobtainlife')}}
        </div>
    </div>
</article>