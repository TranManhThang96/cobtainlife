<!-- footerHolder -->
<aside class="footerHolder overflow-hidden bg-lightGray pb-xl-8 pt-lg-10 pb-lg-8 pt-md-12 pb-md-8 pt-10">
    <div class="container d-flex flex-column align-items-center">
        <div class="row logo">
            <img src="{{asset('storage'.$configs->store_logo['value'])}}" alt="Cobtainlife" />
        </div>
        <div class="row mt-5 mb-0">
            <ul class="footer-menu list-unstyled mx-auto d-flex text-uppercase">
                <li class="nav-item {{request()->route()->getName() == 'web.home' ? 'active' : ''}}">
                    <a class="d-block" href="{{route('web.home')}}">Trang chủ</a>
                </li>
                <li class="nav-item {{request()->route()->getName() == 'web.products.index' ? 'active' : ''}}">
                    <a class="d-block" href="{{route('web.products.index')}}">Cửa hàng</a>
                </li>
                <li class="nav-item {{request()->route()->getName() == 'web.about-us' ? 'active' : ''}}">
                    <a class="d-block" href="{{route('web.about-us')}}">Về chúng tôi</a>
                </li>
                <li class="nav-item {{request()->route()->getName() == 'web.blog.index' ? 'active' : ''}}">
                    <a class="d-block" href="{{route('web.blog.index')}}">Kiến thức</a>
                </li>
                <li class="nav-item {{request()->route()->getName() == 'web.contact-us' ? 'active' : ''}}">
                    <a class="d-block" href="{{route('web.contact-us')}}">Liên hệ</a>
                </li>
            </ul>
        </div>

        <h5 class="shop-name text-uppercase">CÔNG TY TNHH Sản xuất & Thương mại Cobtain Việt Nam </h5>

        <div class="row shop-info">
            <ul class="list-unstyled mb-3">
                <li class="mb-1 d-flex flex-nowrap justify-content-center align-items-center">
                    <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>
                    <address class="m-0 shop-address">{{$configs->store_address['value']}}</address>
                </li>
                <li class="mb-1 d-flex flex-nowrap justify-content-center align-items-center">
                    <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                    <span class="leftAlign">
                        <a href="tel: {{$configs->store_hotline['value']}}">{{$configs->store_hotline['value']}}</a>
                    </span>
                </li>
                <li class="email d-flex flex-nowrap justify-content-center align-items-center"> 
                    <i class="fa fa-globe mr-2" aria-hidden="true"></i>
                    <span class="leftAlign">
                        <a href="mailto: {{$configs->store_email['value']}}">{{$configs->store_email['value']}}</a>
                    </span>
                </li>
            </ul>
        </div>

        <div class="row">
            <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
                <li class="mr-xl-2 mr-md-2 mr-3 font-weight-bold">Follow us:</li>
                <li class="mr-xl-2 mr-md-2 mr-2"><a href="{{$configs->store_facebook_url['value']}}" class="fab fa-facebook-f" target="_blank"></a></li>
                <li class="mr-xl-2 mr-md-2 mr-2"><a href="{{$configs->store_instagram_url['value']}}" class="fab fa-instagram"></a></li>
                <li class="mr-2"><a href="{{$configs->store_youtube_url['value']}}" class="fab fa-youtube"></a></li>
            </ul>
        </div>

    </div>
</aside>