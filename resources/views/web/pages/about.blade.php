@extends('web.layout.full')

@section('content')
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Về Chúng Tôi</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-2"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                    <li class="mr-2">/</li>
                    <li class="active">Về Chúng Tôi</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="abtSecHolder container pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-5">
    <div class="row">
        <div class="col-12 col-lg-6 pt-xl-12 pt-lg-8">
            <h2 class="playfair fwEbold position-relative mb-7 pb-5">
                <strong class="d-block">A Minimal Team</strong>
                <strong class="d-block">For a Better World</strong>
            </h2>
            <p class="pr-xl-16 pr-lg-10 mb-lg-0 mb-6">Lorem Khaled Ipsum is a major key to success. The ladies always say Khaled you smell good, I use no cologne. Cocoa butter is the key. To succeed you must believe. When you believe, you will succeed. They will try to close the door on you, just open it. The key is to drink coconut, fresh coconut, trust me. It’s important to use cocoa butter. It’s the key to more success, why not live smooth?</p>
        </div>
        <div class="col-12 col-lg-6">
            <img src="{{asset('dist/images/570x440.png')}}" alt="image description" class="img-fluid">
        </div>
    </div>
</section>
<section class="teamSec pt-xl-12 pb-xl-21 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-0 pb-4">
    <div class="container">
        <div class="row">
            <header class="col-12 mainHeader mb-9 text-center">
                <h1 class="headingIV playfair fwEblod mb-4">Meet Our Team</h1>
                <span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
            </header>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
                <article class="teamBlock overflow-hidden">
                    <span class="imgWrap position-relative d-block w-100 mb-4">
                        <img src="{{asset('dist/images/370x290.png')}}" class="img-fluid" alt="image description">
                        <ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
                            <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                        </ul>
                    </span>
                    <div class="textDetail w-100 text-center">
                        <h3>
                            <strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">redikiel</a></strong>
                            <strong class="text-capitalize d-block desination">Co - Founder & CEO</strong>
                        </h3>
                    </div>
                </article>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
                <article class="teamBlock overflow-hidden">
                    <span class="imgWrap position-relative d-block w-100 mb-4">
                        <img src="{{asset('dist/images/370x290.png')}}" class="img-fluid" alt="image description">
                        <ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
                            <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                        </ul>
                    </span>
                    <div class="textDetail w-100 text-center">
                        <h3>
                            <strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">Angela</a></strong>
                            <strong class="text-capitalize d-block desination">Chief of Marketing Team</strong>
                        </h3>
                    </div>
                </article>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
                <article class="teamBlock overflow-hidden">
                    <span class="imgWrap position-relative d-block w-100 mb-4">
                        <img src="{{asset('dist/images/370x290.png')}}" class="img-fluid" alt="image description">
                        <ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
                            <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                        </ul>
                    </span>
                    <div class="textDetail w-100 text-center">
                        <h3>
                            <strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">kevin lee</a></strong>
                            <strong class="text-capitalize d-block desination">Art Director</strong>
                        </h3>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection