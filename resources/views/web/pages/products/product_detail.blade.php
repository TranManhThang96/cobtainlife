@extends('web.layout.full')

@section('content')

<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Shop</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-2"><a href="{{route('web.home')}}">Home</a></li>
                    <li class="mr-2">/</li>
                    <li class="mr-2"><a href="{{route('web.products.index')}}">Shop</a></li>
                    <li class="mr-2">/</li>
                    <li class="active">{{$product->name}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- twoColumns -->
<div class="twoColumns container pt-xl-23 pb-xl-20 pt-lg-20 pb-lg-20 py-md-16 py-10">
    <div class="row mb-6">
        <div class="col-12 col-lg-6 order-lg-1">
            <!-- productSliderImage -->
            <div class="productSliderImage mb-lg-0 mb-4">
                <div>
                    <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/570x635.png')}}"' width="570px" height="635px">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 order-lg-3">
            <!-- productTextHolder -->
            <div class="productTextHolder overflow-hidden">
                <h2 class="fwEbold mb-2" id="product-name"
                data-product-id="{{$product->id}}"
                data-product-sku="{{$product->sku}}"
                data-product-full-id="{{$product->id}}"
                data-product-image="{{asset('storage'.$product->image)}}"
                data-product-link="{{route('web.products.show', ['product' => $product->alias])}}"
                data-product-attribute>
                {{$product->name}}
                </h2>
                <!-- <ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
                    <li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
                    <li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
                    <li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
                    <li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
                    <li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
                    <li>( 5 customer reviews )</li>
                </ul> -->
                <strong class="price d-block mb-5 text-green" 
                    id="product-price" 
                    data-product-price="{{$product->promotionValid ? $product->promotion->price_promotion : $product->price}}"
                    data-product-add-price="0"
                    >
                        {{$product->promotionValid ? number_format($product->promotion->price_promotion, 0) : number_format($product->price, 0)}} VND
                </strong>
                <p class="mb-5">{{$product->description}}</p>
                <ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
                    @if (!empty($product->sku))
                        <li class="mb-2">Code: <span>{{$product->sku}}</span></li>
                    @endif
                    <li class="mb-2">Lượt xem: <span>{{$product->view}}</span></li>

                    <!-- <li class="mb-2">Shipping tax: <span>Free</span></li> -->
                </ul>
                @foreach($product->attributes_groups as $attributeGroupId => $attributeGroup)
                <ul class="list-unstyled sizeList d-flex flex-wrap mb-4 attribute-group-options">
                    @foreach($attributeGroup as $key=>$attr)
                    @if ($key == 0)
                    <li class="text-uppercase mr-6">{{$attr['shop_attribute_group']['name']}}</li>
                    @endif
                    <li class="mr-2">
                        <label for="check-{{$attributeGroupId}}-{{$attr['id']}}">
                            <input id="check-{{$attributeGroupId}}-{{$attr['id']}}" type="radio" value="{{$attr['product_id']}}-{{$attr['attribute_group_id']}}-{{$attr['code']}}" name="attribute[{{$attr['product_id']}}][{{$attributeGroupId}}]" class="attribute-option-item" data-attribute-json="{{json_encode($attr)}}" data-add-price="{{$attr['add_price']}}" {{$key == 0 ? 'checked' : ''}}>
                            <span class="fake-input"></span>
                            <span class="fake-label" data-attr-id="{{$attr['id']}}">{{$attr['name']}}(+{{number_format($attr['add_price'], 0)}})</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
                @endforeach
                <div class="holder overflow-hidden d-flex flex-wrap mb-6">
                    <input type="number" placeholder="1" id="product-qty" value="1">
                    <a href="javascript:void(0);" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4 py-md-3 px-md-4" id="detail-btn-add-cart">
                        Thêm vào giỏ hàng <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <ul class="list-unstyled socialNetwork d-flex flex-wrap mb-sm-11 mb-4">
                    <li class="text-uppercase mr-5">Chia sẻ:</li>
                    <li class="mr-4">
                        <i class="fab fa-facebook-f btn-social" data-href="https://facebook.com/sharer/sharer.php?u={{urlencode(route('web.products.show', ['product' => $product->alias]))}}"aria-hidden="true"></i>
                    </li>
                    <li class="mr-4">
                        <i class="fab fa-google-plus btn-social" data-href="https://plus.google.com/share?url={{urlencode(route('web.products.show', ['product' => $product->alias]))}}" aria-hidden="true"></i>
                    </li>
                    <li class="mr-4">
                        <i class="fab fa-twitter btn-social" data-href="https://twitter.com/intent/tweet?text={{$product->alias}}&url={{urlencode(route('web.products.show', ['product' => $product->alias]))}}" aria-hidden="true"></i>
                    </li>
                    <li class="mr-4">
                        <i class="fab fa-linkedin btn-social" data-href="https://www.linkedin.com/sharing/share-offsite/?url={{urlencode(route('web.products.show', ['product' => $product->alias]))}}" aria-hidden="true"></i>
                    </li>
                </ul>
                <ul class="list-unstyled productInfoDetail mb-0">
                    <li class="mb-2">Danh mục:
                        <a href="javascript:void(0);">{{$product->category->title}}</a>
                    </li>
                    <li class="mb-2">Nhà cung cấp:
                        <a href="javascript:void(0);">{{$product->supplier->name ?? 'kk'}}</a>
                    </li>
                    <li>Nhãn hiệu:
                        <a href="javascript:void(0);">{{$product->brand->name ?? ''}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- paggSlider -->
            <div class="paggSlider">
                <div>
                    @foreach($product->images as $productImg)
                    <div class="imgBlock">
                        <img src="{{asset('storage'.$productImg->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/170x190.png')}}"' width="170px" height="190px">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- tabSetList -->
            <ul class="list-unstyled tabSetList d-flex justify-content-center mb-9">
                <li class="mr-md-20 mr-sm-10 mr-2">
                    <a href="#tab1-0" class="active playfair fwEbold pb-2">Mô tả</a>
                </li>
                <li>
                    <a href="#tab2-0" class="playfair fwEbold pb-2">Đánh giá</a>
                </li>
            </ul>
            <!-- tab-content -->
            <div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
                <div id="tab1-0" class="active">
                    <p>
                        {!! $product->content !!}
                    </p>
                </div>
                <div id="tab2-0">
                <div id="tab2-0">
                    <div class="row mb-10">
                        <div class="col-12 border-bottom">
                            <!-- commentsBlock -->
                            <div class="commentsBlock overflow-hidden mb-2">
                                <h4 class="headingVII text-uppercase mb-5">Bình Luận</h4>
                                @foreach($product->comments as $comment)
                                    @if (($configs->comment_auto_hide['value'] ?? '') != \App\Enums\DBConstant::SHOW_COMMENT || (($configs->comment_auto_hide['value'] ?? '') == \App\Enums\DBConstant::SHOW_COMMENT && !in_array($comment->rating, [1,2])))
                                        <!-- commentArea -->
                                        <article class="commentArea overflow-hidden d-flex align-items-start mb-6">
                                            <div class="name text-uppercase">{{sortName($comment->customer_name)}}</div>
                                            <div class="txtHolder border px-2 py-2">
                                                <span class="commentDate d-block mb-2">
                                                    <a href="javascript:void(0);" class="text-capitalize">{{$comment->customer_name}}</a>
                                                    <i class="fas fa-clock ml-2" aria-hidden="true"></i> {{date('d/m/Y H:i:s', strtotime($comment->created_at))}}
                                                    <!-- <a href="javascript:void(0);" class="link text-green">Reply</a> -->
                                                </span>
                                                <p class="mb-1">{{$comment->comment}}</p>
                                            </div>
                                        </article>

                                        @foreach($comment->child as $childComment)
                                        <div class="commentOneLevel pl-md-20 pl-sm-10 pl-0 mb-9">
                                            <article class="commentArea overflow-hidden d-flex align-items-start mb-2">
                                                <div class="name text-uppercase">{{sortName($childComment->customer_name)}}</div>
                                                <div class="txtHolder border px-2 py-2">
                                                    <span class="commentDate d-block mb-2">
                                                        <a href="javascript:void(0);" class="text-capitalize">{{$childComment->customer_name}}</a>
                                                        <i class="fas fa-clock ml-2" aria-hidden="true"></i> {{date('d/m/Y H:i:s', strtotime($childComment->created_at))}}
                                                    </span>
                                                    <p class="mb-1">{{$childComment->comment}}</p>
                                                </div>
                                            </article>
                                        </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if (($configs->comment_enable['value'] ?? '') == \App\Enums\DBConstant::SHOW_COMMENT)
                        <div class="row">
                            <div class="col-12">
                                <!-- commentFormArea -->
                                <div class="commentFormArea">
                                    <form class="commentform" id="comment-form">
                                        <input type="hidden" name="object_id" value="{{$product->id}}" />
                                        <input type="hidden" name="type" value="1" />
                                        <div class="form-group w-100 mb-5 d-flex">
                                            <h2 class="headingVII text-uppercase mr-5 pt-1">Đánh giá</h2>
                                            <ul class="list-unstyled ratingList d-flex flex-nowrap mb-2 comment-rating">
                                                <input type="hidden" name="rating" value="0" />
                                                <li class="mr-2">
                                                    <a href="javascript:void(0);" data-id="star-1" class="star"><i class="far fa-star"></i></a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="javascript:void(0);" data-id="star-2" class="star"><i class="far fa-star"></i></a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="javascript:void(0);" data-id="star-3" class="star"><i class="far fa-star"></i></a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="javascript:void(0);" data-id="star-4" class="star"><i class="far fa-star"></i></a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="javascript:void(0);" data-id="star-5" class="star"><i class="far fa-star"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="form-group w-100 mb-5">
                                            <textarea class="form-control" placeholder="bình luận" name="comment"></textarea>
                                        </div>
                                        <div class="d-flex flex-wrap row1 mb-md-5">
                                            <div class="form-group coll mb-5">
                                                <label for="name" class="mb-1">Họ và tên *</label>
                                                <input type="text" id="name" class="form-control" name="customer_name" />
                                            </div>
                                            <div class="form-group coll mb-5">
                                                <label for="email" class="mb-1">Email *</label>
                                                <input type="email" class="form-control" id="email" name="customer_email" />
                                            </div>
                                            <div class="form-group coll mb-5">
                                                <label for="website" class="mb-1">Website</label>
                                                <input type="text" class="form-control" id="website" name="customer_website" />
                                            </div>
                                        </div>
                                        <button class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4" id="comment-btn" data-object-id="{{$product->id}}">Bình luận<i class="fas fa-arrow-right ml-2"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- featureSec -->
<section class="featureSec container overflow-hidden pt-xl-12 pb-xl-29 pt-lg-10 pb-lg-14 pt-md-8 pb-md-10 py-5">
    <div class="row">
        <!-- mainHeader -->
        <header class="col-12 mainHeader mb-5 text-center">
            <h1 class="headingIV playfair fwEblod mb-4">Related products</h1>
        </header>
    </div>
    <div class="row">
        @foreach($relatedProducts as $product)
        <!-- featureCol -->
        <div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-7">
            <div class="border">
                <div class="imgHolder position-relative w-100 overflow-hidden">
                    <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}" onerror='this.src="{{asset('dist/images/270x300.png')}}"' width="270px" height="300px">
                    <ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
                        <li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
                        <li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
                        <li class="mr-2 overflow-hidden"><a href="{{route('web.products.show', ['product' => $product->alias])}}" class="icon-eye d-block"></a></li>
                        <li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
                    </ul>
                </div>
                <div class="text-center py-5 px-4">
                    <span class="title d-block mb-2"><a href="{{route('web.products.show', ['product' => $product->alias])}}">{{$product->name}}</a></span>
                    @if($product->promotionValid)
                    <span class="price d-block pb-1"><del>{{number_format($product->price, 0)}} VND</del></span>
                    <span class="price d-block fwEbold">{{number_format($product->promotion->price_promotion, 0)}} VND</span>
                    @else
                    <span class="price d-block fwEbold">{{number_format($product->price, 0)}} VND</span>
                    @endif
                    @if($product->promotionValid)
                    <span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('css')
<link href="{{asset('css/web/products/detail.css')}}" rel="stylesheet">
</link>
@endsection

@section('script')
    <script src="{{asset('assets/extra-libs/nameBadges/jquery.nameBadges.js')}}" rel="stylesheet"></script>
    <script src="{{asset('js/web/products/detail.js')}}" rel="stylesheet"></script>
@endsection