<article id="content">
    <div class="row">
        @foreach($products as $product)
        <!-- class="img-fluid w-100" bo class cua image -->
        <div class="col-12 col-sm-6 col-lg-4 featureCol mb-7 compare-product">
            <div class="border">
                <div class="imgHolder position-relative w-100 overflow-hidden">
                    <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/70x300.png')}}"' width="270px" height="300px">
                </div>
                <div class="text-center pt-5 px-4">
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
                <div class="text-center">
                    <a href="javascript:void(0);" class="fas fa-times remove-compare-item py-3" data-product-id="{{$product->id}}"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</article>