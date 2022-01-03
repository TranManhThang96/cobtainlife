<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the Compatible of your site -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
	<!-- set the page title -->
	<title>Cobtainlife</title>
	<!-- include the site Google Fonts stylesheet -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700%7CRoboto:300,400,500,700,900&display=swap" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link href="{{asset('dist/css/bootstrap.css')}}" rel="stylesheet"/>
	<!-- include the site fontawesome stylesheet -->
	<link href="{{asset('dist/css/fontawesome.css')}}" rel="stylesheet"/>
	<!-- include the site stylesheet -->
	<link href="{{asset('dist/css/cobtainlife.css')}}" rel="stylesheet"/>
	<!-- include theme plugins setting stylesheet -->
	<link href="{{asset('dist/css/plugins.css')}}" rel="stylesheet"/>
	<!-- include theme color setting stylesheet -->
	<link href="{{asset('dist/css/color.css')}}" rel="stylesheet"/>
	<!-- include theme responsive setting stylesheet -->
	<link href="{{asset('dist/css/responsive.css')}}" rel="stylesheet"/>
	<!-- toast -->
	<link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('css/web/app.css')}}" rel="stylesheet">
	@yield('css')
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<div class="bg-loader">
			<div class="loader">
				<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			</div>
		</div>
		<!-- loading -->

        <!-- header -->
        @include('web.layout.base._header')

		<!-- main -->
        
		<main>
			@yield('content')

            <div class="container mb-lg-24 mb-md-16 mb-10">
                <!-- subscribeSecBlock -->
                <section class="subscribeSecBlock bgCover col-12 pt-lg-24 pb-lg-12 pt-md-16 pb-md-8 py-10" style="background-image: url({{$configs->store_background_subscribe['value'] ? asset('storage'.$configs->store_background_subscribe['value']) : asset('dist/images/1170x465.png')}})">
                    <header class="col-12 mainHeader mb-9 text-center">
                        <h1 class="headingIV playfair fwEblod mb-4">Đăng ký</h1>
                        <span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
                        <p class="mb-6">Vui lòng nhập địa chỉ email của bạn để luôn nhận được những khuyến mại hấp dẫn.</p>
                    </header>
                    <form class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap" id="frm-subscribe-news">
						@csrf
                        <input type="email" class="form-control px-4 border-0" placeholder="Địa chỉ email..." name="email">
                        <button class="btn btnTheme btnShop fwEbold text-white py-3 px-4 py-md-3 px-md-4" id="btn-subscribe-news">
							Đăng ký 
							<i class="fas fa-arrow-right ml-2"></i>
						</button>
                    </form>
                </section>
            </div>
			
			@include('web.layout.base._footer_holder')
		</main>

        <!-- footer -->
        @include('web.layout.base._footer')
	</div>
	<!-- include jQuery library -->
	<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
	<!-- include bootstrap popper JavaScript -->
	<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
	<!-- include bootstrap JavaScript -->
	<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<!-- include custom JavaScript -->
	<script src="{{asset('dist/js/jqueryCustome.js')}}"></script>
	<!-- toast -->
	<script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
	<script src="{{asset('js/web/app.js')}}"></script>
	<script src="{{asset('js/web/common/local_storage.js')}}"></script>
	<script src="{{asset('js/web/common/utils.js')}}"></script>
	<script src="{{asset('js/web/common/cart.js')}}"></script>

	@yield('script')
</body>
</html>