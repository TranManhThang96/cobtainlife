@extends('web.layout.default')

@section('content')
<!-- bannerBlockHolder -->
<section class="bannerBlockHolder position-relative">
	<div class="slick-fade">
		@foreach($banners as $kbanner=>$banner)
			@if ($kbanner % 2 == 0)
				<div>
					<!-- align -->
					<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url({{$banner->image ? asset('storage'.$banner->image) : asset('dist/images/1920x900.png')}})">
						<div class="container position-relative holder pt-xl-10">
							<div class="row">
								<div class="col-12 col-xl-7">
									<div class="txtwrap pr-xl-10">
										<!-- <span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-md-5 mb-sm-3">wellcome to botanical</span>
										<h1 class="fwEbold position-relative mb-md-7 mb-sm-4">Houseplant <span class="text-break d-block">The Perfect Choice.</span></h1>
										<p class="mb-md-15 mb-sm-10">Lorem ipsum is simply dummy text of the printing and typesetting industry.</p> -->
										{!! $banner->html !!}
										<a href="{{route('web.products.index')}}" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4">Cửa Hàng <i class="fas fa-arrow-right ml-2"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@else	
				<div>
					<!-- align -->
					<div class="align w-100 bgCover" style="background-image: url({{$banner->image ? asset('storage'.$banner->image) : asset('dist/images/1920x900.png')}});">
						<div class="container position-relative holder pt-14">
							<!-- py-12 pt-lg-30 pb-lg-25 -->
							<div class="row">
								<div class="col-12 text-center">
									<div class="txtwrap pr-md-10">
										<!-- <h1 class="fwEbold position-relative mb-0">NUTRIENTS PLANTS</h1>
										<strong class="year d-block fwEbold mb-3">2019</strong>
										<span class="sub-title d-block text-uppercase mb-md-12 mb-6">OCCASSIONAL BOUQUET</span> -->
										{!! $banner->html !!}
										<a href="{{route('web.products.index')}}" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4">Cửa Hàng <i class="fas fa-arrow-right ml-2"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif	
		@endforeach
	</div>
	<div class="slickNavigatorsWrap">
		<a href="#" class="slick-prev"><i class="icon-leftarrow"></i></a>
		<a href="#" class="slick-next"><i class="icon-rightarrow"></i></a>
	</div>
</section>
<!-- contactListBlock -->
<div class="contactListBlock container overflow-hidden pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-4 pt-10 pb-1">
	<div class="row">
		<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
			<!-- contactListColumn -->
			<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
				<span class="icon icon-van"></span>
				<div class="alignLeft pl-2">
					<strong class="headingV fwEbold d-block mb-1">Free shipping order</strong>
					<p class="m-0">On orders over $100</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
			<!-- contactListColumn -->
			<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
				<span class="icon icon-gift"></span>
				<div class="alignLeft pl-2">
					<strong class="headingV fwEbold d-block mb-1">Special gift card</strong>
					<p class="m-0">The perfect gift idea</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
			<!-- contactListColumn -->
			<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-4 px-md-2 px-3 d-flex">
				<span class="icon icon-recycle"></span>
				<div class="alignLeft pl-2">
					<strong class="headingV fwEbold d-block mb-1">Return &amp; exchange</strong>
					<p class="m-0">Free return within 3 days</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
			<!-- contactListColumn -->
			<div class="contactListColumn border bg-lightGray overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
				<span class="icon icon-call"></span>
				<div class="alignLeft pl-2">
					<strong class="headingV fwEbold d-block mb-1">Support 24 / 7</strong>
					<p class="m-0">Customer support</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container pt-xl-11 pb-xl-12 pt-lg-10 pb-lg-10 pt-md-8 pb-md-8 pt-5 pb-5">
	<div class="row">
		<div class="col-12">
			<!-- quotationBlock -->
			<blockquote class="quotationBlock text-center d-block m-0">
				<q class="d-block playfair mb-7">We ship healthy potted plants right to your doorstep. Each plant comes with simple care instructions from our plant experts.</q>
				<cite class="d-block">
					<img src="{{asset('dist/images/signature.png')}}" alt="signature" class="img-fluid mb-6">
					<span class="d-flex flex-nowrap align-items-center justify-content-center">
						<strong class="fwEbold mr-1">Sarah Jefferson</strong>
						<span class="text-uppercase fwEbold pt-1">- CEO</span>
					</span>
				</cite>
			</blockquote>
		</div>
	</div>
</div>
<!-- featureSec -->
<section class="featureSec container overflow-hidden pt-xl-12 pb-xl-9 pt-lg-10 pb-lg-4 pt-md-8 pb-md-2 pt-5">
	<div class="row">
		<!-- mainHeader -->
		<header class="col-12 mainHeader mb-4 text-center">
			<h1 class="headingIV playfair fwEblod mb-4">New Arrival</h1>
			<span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
			<p>There are many variations of passages of lorem ipsum available </p>
		</header>
	</div>
	<div class="row">
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Sit voluptatem</a></span>
					<span class="price d-block fwEbold">68.00 $</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold">58.00 $</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold">60.00 $</span>
					<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">Hot</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold"><del>80.50 $</del>65.00 $</span>
					<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- categorySecBlock -->
<div class="categorySecBlock overflow-hidden pt-xl-9 pb-xl-6 px-xl-17 px-0 pt-lg-10 pb-lg-4 pt-md-8 pb-md-2 pt-5">
	<!-- masonryHolder -->
	<div class="masonryHolder">
		<!-- grid-item -->
		<div class="grid-item mb-6 px-3">
			<div class="itemCol">
				<div class="position-relative">
					<img src="{{asset('dist/images/410x845.png')}}" alt="image description" class="img-fluid w-100">
					<div class="hoverTextBlock position-absolute">
						<h2 class="headingIV playfair fwEbold mb-3"><a href="javascript:void(0);">Cactus Plant</a></h2>
						<span class="txt d-block">( 56 item )</span>
					</div>
				</div>
			</div>
		</div>
		<!-- grid-item -->
		<div class="grid-item mb-6 px-3">
			<div class="itemCol">
				<div class="position-relative">
					<img src="{{asset('dist/images/410x410.png')}}" alt="image description" class="img-fluid w-100">
					<div class="hoverTextBlock position-absolute">
						<h2 class="headingIV playfair fwEbold mb-3"><a href="javascript:void(0);">Indoor Plant</a></h2>
						<span class="txt d-block">( 36 item )</span>
					</div>
				</div>
			</div>
		</div>
		<!-- grid-item -->
		<div class="grid-item grid-item2 mb-6 px-3">
			<div class="itemCol">
				<div class="position-relative">
					<img src="{{asset('dist/images/845x410.png')}}" alt="image description" class="img-fluid w-100">
					<div class="hoverTextBlock position-absolute">
						<h2 class="headingIV playfair fwEbold mb-3"><a href="javascript:void(0);">Tropical Plant</a></h2>
						<span class="txt d-block">( 21 item )</span>
					</div>
				</div>
			</div>
		</div>
		<!-- grid-item -->
		<div class="grid-item grid-item2 mb-6 px-3">
			<div class="itemCol">
				<div class="position-relative">
					<img src="{{asset('dist/images/845x410.png')}}" alt="image description" class="img-fluid w-100">
					<div class="hoverTextBlock position-absolute">
						<h2 class="headingIV playfair fwEbold mb-3"><a href="javascript:void(0);">Floor Plant</a></h2>
						<span class="txt d-block">( 18 item )</span>
					</div>
				</div>
			</div>
		</div>
		<!-- grid-item -->
		<div class="grid-item mb-6 px-3">
			<div class="itemCol">
				<div class="position-relative">
					<img src="{{asset('dist/images/410x410.png')}}" alt="image description" class="img-fluid w-100">
					<div class="hoverTextBlock position-absolute">
						<h2 class="headingIV playfair fwEbold mb-3"><a href="javascript:void(0);">Table Plant</a></h2>
						<span class="txt d-block">( 36 item )</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- featureSec -->
<section class="featureSec container overflow-hidden pt-xl-11 pb-xl-18 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-5 pb-5">
	<div class="row">
		<!-- mainHeader -->
		<header class="col-12 mainHeader mb-4 text-center">
			<h1 class="headingIV playfair fwEblod mb-4">Best seller</h1>
			<span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
			<p>There are many variations of passages of lorem ipsum available </p>
		</header>
	</div>
	<div class="row">
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold mb-1"><del>80.50 $</del> 68.00 $</span>
					<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
					<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold mb-1">58.00 $</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold mb-1">60.00 $</span>
					<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">Hot</span>
				</div>
			</div>
		</div>
		<!-- featureCol -->
		<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
			<div class="border">
				<div class="imgHolder position-relative w-100 overflow-hidden">
					<img src="{{asset('dist/images/270x300.png')}}" alt="image description" class="img-fluid w-100">
					<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
						<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-eye d-block"></a></li>
						<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
					</ul>
				</div>
				<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
					<span class="title d-block mb-2"><a href="shop-detail.html">Pellentesque aliquet</a></span>
					<span class="price d-block fwEbold mb-1"><del>80.50 $</del>65.00 $</span>
					<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container-fluid px-xl-20 px-lg-10">
	<!-- testimonailBlock -->
	<section class="testimonailBlock bgCover py-xl-24 py-lg-20 py-md-16 py-10" style="background-image: url({{asset('dist/images/1720x560.png')}})">
		<header class="col-12 mainHeader mb-9 text-center">
			<h1 class="headingIV playfair fwEblod">What Say Client</h1>
		</header>
		<div class="container">
			<!-- testimonailSlider -->
			<div class="testimonailSlider overflow-hidden">
				<div>
					<div class="slide text-center mb-7">
						<span class="icon-qoute mb-2 d-block"></span>
						<p class="mb-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com- modo consequat. </p>
						<strong class="title d-block fwEbold mb-1">Sarah Jefferson</strong>
						<span class="desination">BTV - Designer</span>
					</div>
				</div>
				<div>
					<div class="slide text-center mb-7">
						<span class="icon-qoute mb-2 d-block"></span>
						<p class="mb-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com- modo consequat. </p>
						<strong class="title d-block fwEbold mb-1">Sarah Jefferson</strong>
						<span class="desination">BTV - Designer</span>
					</div>
				</div>
				<div>
					<div class="slide text-center mb-7">
						<span class="icon-qoute mb-2 d-block"></span>
						<p class="mb-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com- modo consequat. </p>
						<strong class="title d-block fwEbold mb-1">Sarah Jefferson</strong>
						<span class="desination">BTV - Designer</span>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- latestSec -->
<section class="latestSec container overflow-hidden pt-xl-23 pb-xl-17 pt-lg-20 pb-lg-4 pt-md-16 pb-md-2 pt-10">
	<div class="row">
		<!-- mainHeader -->
		<header class="col-12 mainHeader mb-4 text-center">
			<h1 class="headingIV playfair fwEblod mb-4">Bài viết gần nhất</h1>
			<span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
		</header>
	</div>
	<div class="row">
		@foreach($lastNews as $news)
			<div class="col-12 col-sm-6 col-lg-4">
				<!-- newsPostColumn -->
				<div class="newsPostColumn text-center px-2 pb-6 mb-6">
					<div class="imgHolder position-relative mb-6">
						<a href="{{route('web.blog.show', ['blog' => $news->alias])}}">
							<img src="{{asset('storage'.$news->image)}}" alt="{{$news->name}}" onerror='this.src="{{asset('dist/images/370x250.png')}}"' width="370px" height="250px">
							<time class="time text-uppercase position-absolute py-2 px-1" datetime="{{$news->created_at}}"> 
								<strong class="fwEbold d-block">{{readDateTime($news->created_at, 'd')}}</strong> {{readDateTime($news->created_at, 'M')}}
							</time>
						</a>
					</div>
					<span class="postBy d-block mb-3">Đăng bởi: <a href="{{route('web.blog.show', ['blog' => $news->alias])}}">Cobtainlife</a></span>
					<h2 class="headingV fwEbold mb-2"><a href="{{route('web.blog.show', ['blog' => $news->alias])}}">{{$news->title ?? ''}}</a></h2>
					<p class="mb-0 text-truncate" style="max-width: 40vw">{{$news->description}}</p>
				</div>
			</div>
		@endforeach
	</div>
</section>
@endsection