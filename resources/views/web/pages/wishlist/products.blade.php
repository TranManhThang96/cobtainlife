<div class="row">
    <div class="col-md-12 text-danger">
        <div class="table-responsive">
            <table class="table box table-bordered">
                <thead>
                    <tr style="background: #eaebec;">
                        <th style="width: 100px;">SKU</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="row_cart wishlist">
                            <td>{{$product->sku}}</td>
                            <td class="title">
                                <a href="{{route('web.products.show', ['product' => $product->alias])}}" class="row_cart-name">
                                    <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/70x80.png')}}"' width="70px" height="80px">
                                    <span> {{$product->name}}<br /> </span>
                                </a>
                            </td>
                            <td>
                                <div class="product-price-wrap">
                                    @if($product->promotionValid)
                                    <span class="price d-block fwEbold">
                                        <del>{{number_format($product->price, 0)}} VND</del><br/>
                                        {{number_format($product->promotion->price_promotion, 0)}} VND
                                    </span>
                                    @else
                                    <span class="price d-block fwEbold">{{number_format($product->price, 0)}} VND</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center pt-5">
                                <a href="javascript:void(0);" class="fas fa-times remove-wishlist-item pt-5" data-product-id="{{$product->id}}"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
