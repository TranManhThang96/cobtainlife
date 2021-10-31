<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the Compatible of your site -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<!-- set the page title -->
	<title>Botanical - HTML5 Ecommerce Template</title>
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

	@yield('css')
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
        <!-- header -->
        @include('web.layout.base._header')

		<!-- main -->
        
		<main>
			@yield('content')
			
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