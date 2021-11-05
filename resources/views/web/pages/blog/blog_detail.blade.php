@extends('web.layout.default')

@section('content')
<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Tin tức</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-sm-2 mr-1"><a href="home.html">Trang chủ</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="mr-sm-2 mr-1"><a href="blog.html">Tin tức</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="active">{{$news->title}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- twoColumns -->
<div class="twoColumns container pt-xl-23 pb-xl-20 py-lg-20 py-md-16 py-10">
    <div class="row border-bottom mb-9">
        <div class="col-12 col-lg-9 order-lg-3">
            <!-- newsBlogColumn -->
            <div class="newsBlogColumn mb-9">
                <div class="imgHolder mb-6">
                    <img src="{{asset('storage'.$news->image)}}" alt="{{$news->name}}" onerror='this.src="{{asset('dist/images/870x450.png')}}"' width="870px" height="450px">
                </div>
                <div class="textHolder d-flex align-items-start mb-1">
                    <time class="time text-center text-uppercase py-sm-3 py-1 px-1" datetime="2019-02-03 20:00"> <strong class="fwEbold d-block mb-1">20</strong> Sep</time>
                    <div class="alignLeft pl-6 w-100">
                        <h2 class="headingV fwEbold mb-2">{{$news->title}}</h2>
                        <span class="postBy d-block pb-6 mb-3">Đăng bởi: Cobtainlife</span>
                    </div>
                </div>
                {!! $news->content !!}
            </div>
        </div>
        <div class="col-12 col-lg-3 order-lg-1">
            <!-- sidebar -->
            <aside id="sidebar">
                <section class="widget overflow-hidden mb-md-9 mb-6">
                    <h3 class="headingVII fwEbold text-uppercase mb-2">Bài viết gần đây</h3>
                    <ul class="list-unstyled recentPostList mb-0">
                        @foreach($recentNews as $recentNewsItem)
                        <li><a href="{{route('web.blog.show', ['blog' => $recentNewsItem->alias])}}" class="py-2 d-block">{{$recentNewsItem->title}}</a></li>
                        @endforeach
                    </ul>
                </section>
                <!-- widget -->
                <section class="widget overflow-hidden mb-md-6 mb-3">
                    <h3 class="headingVII fwEbold text-uppercase mb-4">Lưu trữ</h3>
                    <ul class="list-unstyled archiveList mb-0">
                        @foreach($archives as $archive)
                        <li class="mb-3"><a href="{{route('web.blog.type', ['type' => 'date', 'value' => $archive->new_date])}}" class="d-block">{{getMonth($archive->month)}} - {{$archive->year}}</a></li>
                        @endforeach
                    </ul>
                </section>
                <!-- widget -->
                <section class="widget overflow-hidden mb-md-5 mb-3">
                    <h3 class="headingVII fwEbold text-uppercase mb-4">Tags</h3>
                    <ul class="list-unstyled tagNavList d-flex flex-wrap mb-0">
                        @foreach($tags as $tag)
                        <li class="text-center"><a href="{{route('web.blog.type', ['type' => 'tags', 'value' => $tag->alias])}}" class="md-round d-block">{{$tag->label}}</a></li>
                        @endforeach
                    </ul>
                </section>
            </aside>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- socialNetworkList -->
            <ul class="list-unstyled socialNetworkList d-flex flex-nowrap mb-5">
                <li class="text-uppercase mr-12">Chia sẻ bài viết:</li>
                <li class="mr-4">
                    <i class="fab fa-facebook-f btn-social" data-href="https://facebook.com/sharer/sharer.php?u={{urlencode(route('web.blog.show', ['blog' => $news->alias]))}}"aria-hidden="true"></i>
                </li>
                <li class="mr-4">
                <i class="fab fa-google-plus btn-social" data-href="https://plus.google.com/share?url={{route('web.blog.show', ['blog' => $news->alias])}}" aria-hidden="true"></i>
                </li>
                <li class="mr-4">
                    <i class="fab fa-twitter btn-social" data-href="https://twitter.com/intent/tweet?text={{$news->alias}}&url={{route('web.blog.show', ['blog' => $news->alias])}}" aria-hidden="true"></i>
                </li>
                <li class="mr-4">
                    <i class="fab fa-linkedin btn-social" data-href="https://www.linkedin.com/shareArticle/?mini=true&url={{route('web.blog.show', ['blog' => $news->alias])}}&title={{$news->title}}&summary={{$news->alias}}&source={{route('web.blog.show', ['blog' => $news->alias])}}" aria-hidden="true"></i>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-10">
        <div class="col-12 border-bottom">
            <!-- commentsBlock -->
            <div class="commentsBlock overflow-hidden mb-2">
                <h4 class="headingVII text-uppercase mb-5">3 COMMENTS</h4>
                <!-- commentArea -->
                <article class="commentArea overflow-hidden d-flex align-items-start mb-6">
                    <a href="javascript:void(0);" class="img rounded pr-5"><img src="{{asset('dist/images/70x70.png')}}" alt="image description" class="img-fluid"></a>
                    <div class="txtHolder border px-2 py-2">
                        <span class="commentDate d-block mb-2"><a href="javascript:void(0);">Admin</a> Post authorOctober 6, 2014 at 1:38 am <a href="javascript:void(0);" class="link text-green">Reply</a></span>
                        <p class="mb-1">just a nice post</p>
                    </div>
                </article>
                <!-- comment one level of the page -->
                <div class="commentOneLevel pl-md-20 pl-sm-10 pl-0 mb-9">
                    <article class="commentArea overflow-hidden d-flex align-items-start mb-2">
                        <a href="javascript:void(0);" class="img rounded pr-5"><img src="{{asset('dist/images/70x70.png')}}" alt="image description" class="img-fluid"></a>
                        <div class="txtHolder border px-2 py-2">
                            <span class="commentDate d-block mb-2"><a href="javascript:void(0);">Admin</a> Post authorOctober 6, 2014 at 1:38 am <a href="javascript:void(0);" class="link text-green">Reply</a></span>
                            <p class="mb-1">Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                        </div>
                    </article>
                </div>
                <!-- comment area of the page -->
                <article class="commentArea overflow-hidden d-flex align-items-start mb-6">
                    <a href="javascript:void(0);" class="img rounded pr-5"><img src="{{asset('dist/images/70x70.png')}}" alt="image description" class="img-fluid"></a>
                    <div class="txtHolder border px-2 py-2">
                        <span class="commentDate d-block mb-2"><a href="javascript:void(0);">Admin</a> Post authorOctober 6, 2014 at 1:38 am <a href="javascript:void(0);" class="link text-green">Reply</a></span>
                        <p class="mb-1">Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean at justo dolor. Fusce ac sapien bibendum, scelerisque libero nec Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean at justo dolor. Fusce ac sapien bibendum, scelerisque libero nec</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- commentFormArea -->
            <div class="commentFormArea">
                <h2 class="headingVII text-uppercase mb-5">LeaVe A Comment</h2>
                <form class="commentform">
                    <div class="form-group w-100 mb-5">
                        <textarea class="form-control" placeholder="comment"></textarea>
                    </div>
                    <div class="d-flex flex-wrap row1 mb-md-5">
                        <div class="form-group coll mb-5">
                            <label for="name" class="mb-1">Name *</label>
                            <input type="text" id="name" class="form-control" name="name">
                        </div>
                        <div class="form-group coll mb-5">
                            <label for="email" class="mb-1">Email *</label>
                            <input type="email" class="form-control" id="email" name="Email">
                        </div>
                        <div class="form-group coll mb-5">
                            <label for="website" class="mb-1">Website *</label>
                            <input type="text" class="form-control" id="website" name="Email">
                        </div>
                    </div>
                    <button type="submit" class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Post Now <i class="fas fa-arrow-right ml-2"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mb-lg-24 mb-md-16 mb-10">
    <!-- subscribeSecBlock -->
    <section class="subscribeSecBlock bgCover col-12 pt-lg-24 pb-lg-12 pt-md-16 pb-md-8 py-10" style="background-image: url({{asset('dist/images/1170x465.png')}})">
        <header class="col-12 mainHeader mb-9 text-center">
            <h1 class="headingIV playfair fwEblod mb-4">Subscribe Our Newsletter</h1>
            <span class="headerBorder d-block mb-5"><img src="{{asset('dist/images/hbdr.png')}}" alt="Header Border" class="img-fluid img-bdr"></span>
            <p class="mb-6">Enter Your email address to join our mailing list and keep yourself update</p>
        </header>
        <form class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
            <input type="email" class="form-control px-4 border-0" placeholder="Enter your mail...">
            <button type="submit" class="btn btnTheme btnShop fwEbold text-white py-3 px-4 py-md-3 px-md-4">Shop Now <i class="fas fa-arrow-right ml-2"></i></button>
        </form>
    </section>
</div>
@endsection