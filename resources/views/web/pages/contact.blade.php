@extends('web.layout.default')

@section('content')
<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Liên Hệ</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-2"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                    <li class="mr-2">/</li>
                    <li class="active">Liên Hệ</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="contactSec container pt-xl-24 pb-xl-23 py-lg-20 pt-md-16 pb-md-10 pt-10 pb-0">
    <div class="row">
        <div class="col-12">
            <ul class="list-unstyled contactListHolder mb-0 d-flex flex-wrap text-center">
                <li class="mb-lg-0 mb-6">
                    <span class="icon d-block mx-auto bg-lightGray py-4 mb-4"><i class="fas fa-map-marker-alt"></i></span>
                    <strong class="title text-uppercase playfair mb-5 d-block">Địa chỉ</strong>
                    <address class="mb-0">Nhà C7, Khu biệt thự 130 Đốc Ngữ, Phường Vĩnh Phúc <span class="d-block"> Quận Ba Đình, Hà Nội</span></address>
                </li>
                <li class="mb-lg-0 mb-6">
                    <span class="icon d-block mx-auto bg-lightGray py-4 mb-3"><i class="fas fa-headphones"></i></span>
                    <strong class="title text-uppercase playfair mb-5 d-block">Số điện thoại</strong>
                    <a href="tel:84917891616" class="d-block">(+84) - 91 789 1616</a>
                </li>
                <li class="mb-lg-0 mb-6">
                    <span class="icon d-block mx-auto bg-lightGray py-5 mb-3"><i class="fas fa-envelope"></i></span>
                    <strong class="title text-uppercase playfair mb-5 d-block">Email</strong>
                    <a href="#" class="d-block">cobtainlife@gmail.com</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- mapHolder -->
<div class="mapHolder">
<iframe src="{{$configs->store_google_embed['value'] ?? ''}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<section class="contactSecBlock container pt-xl-23 pb-xl-24 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 py-10">
    <div class="row">
        <header class="col-12 mainHeader mb-10 text-center">
            <h1 class="headingIV playfair fwEblod mb-7">Liên hệ</h1>
            <p>Để lại lời nhắn, chúng tôi sẽ liên hệ lại với bạn.</p>
        </header>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="contactForm" id="frm-contact-me">
                @csrf
                <input type="hidden" name="type" value="1">
                <div class="d-flex flex-wrap row1 mb-md-1">
                    <div class="form-group coll mb-5">
                        <input type="text" id="name" name="name" class="form-control" name="name" placeholder="Tên  *">
                    </div>
                    <div class="form-group coll mb-5">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email  *">
                    </div>
                    <div class="form-group coll mb-5">
                        <input type="tel" class="form-control" id="tel" name="phone" placeholder="Số điện thoại  *">
                    </div>
                </div>
                <div class="form-group w-100 mb-6">
                    <textarea class="form-control" placeholder="Lời nhắn  *" name="content"></textarea>
                </div>
                <div class="text-center">
                    <button class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4" id="btn-contact-me">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection