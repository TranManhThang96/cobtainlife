<header id="header" class="position-relative">
    <!-- headerHolderCol -->
    <div class="headerHolderCol pt-lg-4 pb-lg-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <a href="javascript:void(0);" class="tel d-flex align-items-end"><i class="icon-call mr-2"></i>{{$configs->store_hotline['value']}}</a>
                </div>
                <div class="col-12 col-sm-4 text-center">
                    <span class="txt d-block">{{$configs->store_welcome['value']}}</span>
                </div>
                <div class="col-12 col-sm-4">
                    <!-- langListII -->
                    <!-- <ul class="nav nav-tabs langListII justify-content-end border-bottom-0">
                        <li class="dropdown">
                            <span>Currency: </span>
                            <a class="d-inline dropdown-toggle text-uppercase" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false">USD</a>
                            <div class="dropdown-menu text-uppercase pl-4 pr-4 border-0">
                                <a class="dropdown-item" href="javascript:void(0);">USD</a>
                                <a class="dropdown-item" href="javascript:void(0);">VND</a>
                                <a class="dropdown-item" href="javascript:void(0);">euro</a>
                            </div>
                        </li>
                        <li class="dropdown m-0">
                            <span>Languages: </span>
                            <a class="d-inline dropdown-toggle text-uppercase" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false">EN</a>
                            <div class="dropdown-menu pl-4 pr-4">
                                <a class="dropdown-item" href="javascript:void(0);">English</a>
                                <a class="dropdown-item" href="javascript:void(0);">Vietnamese</a>
                                <a class="dropdown-item" href="javascript:void(0);">French</a>
                            </div>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
    <div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
        <div class="row">
            <div class="col-6 col-sm-2">
                <!-- mainLogo -->
                <div class="logo">
                    <a href="{{route('web.home')}}"><img src="{{asset('storage'.$configs->store_logo['value'])}}" alt="Cobtainlife" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-6 col-sm-7 col-lg-8 static-block">
                <!-- mainHolder -->
                <div class="mainHolder pt-lg-5 pt-3 justify-content-center">
                    <!-- pageNav2 -->
                    <nav class="navbar navbar-expand-lg navbar-light p-0 pageNav2 position-static">
                        <button type="button" class="navbar-toggle collapsed position-relative" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mx-auto text-uppercase d-inline-block">
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
                    </nav>
                </div>
            </div>
            <div class="col-sm-3 col-lg-2">
                <!-- wishListII -->
                <ul class="nav nav-tabs wishListII pt-5 justify-content-end border-bottom-0">
                    <!-- search -->
                    <li class="nav-item ml-0">
                        <div class="navbar-search">
                            <a class="nav-link navbar-search-icon icon-search" href="javascript:void(0);"></a>
                            <form class="rd-search" action="{{route('web.products.index')}}" method="GET">
                                <div class="form-wrap">
                                    <input class="rd-navbar-search-form-input form-input" type="text" name="q" placeholder="Nhập từ khóa">
                                    <button class="rd-search-form-submit" type="submit"></button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <!-- end search -->

                    <!-- cart -->
                    <li class="nav-item">
                        <a class="nav-link position-relative icon-cart" href="{{route('web.cart.index')}}">
                            <span class="num rounded d-block" id="qty-product-cart">0</span>
                        </a>
                    </li>
                    <!-- end cart -->

                    <!-- login -->
                    <li class="nav-item">
                        <a class="nav-link icon-profile" href="javascript:void(0);" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu">
							<!-- <a class="dropdown-item px-2" href="javascript:void(0);">
                                <i class="fa fa-user pr-1"></i>
                                Đăng nhập
                            </a> -->
							<a class="dropdown-item px-2" href="{{route('web.wishlist')}}">
                                <i class="fas fa-heart pr-1"></i>
                                Yêu thích (<span id="count-wishlist">0</span>)
                            </a>
							<a class="dropdown-item px-2" href="{{route('web.compare')}}">
                                <i class="icon-arrow pr-1"></i>
                                So sánh (<span id="count-compare-list">0</span>)
                            </a>
						</div>
                    </li>
                    <!-- end login -->

                </ul>
            </div>
        </div>
    </div>
</header>