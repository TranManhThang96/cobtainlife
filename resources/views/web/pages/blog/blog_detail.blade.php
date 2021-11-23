@extends('web.layout.full')

@section('content')
<!-- introBannerHolder -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{$configs->store_background['value'] ? asset('storage'.$configs->store_background['value']) : asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Kiến thức</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-sm-2 mr-1"><a href="home.html">Trang chủ</a></li>
                    <li class="mr-sm-2 mr-1">/</li>
                    <li class="mr-sm-2 mr-1"><a href="blog.html">Kiến thức</a></li>
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
                <h4 class="headingVII text-uppercase mb-5">Bình Luận</h4>
                @foreach($news->comments as $comment)
                    <!-- commentArea -->
                    <article class="commentArea overflow-hidden d-flex align-items-start mb-6">
                        <a href="javascript:void(0);" class="img rounded pr-5"><img src="{{asset('dist/images/70x70.png')}}" alt="image description" class="img-fluid"></a>
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
								<a href="javascript:void(0);" class="img rounded pr-5"><img src="{{asset('dist/images/70x70.png')}}" alt="image description" class="img-fluid"></a>
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
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- commentFormArea -->
            <div class="commentFormArea">
                <form class="commentform" id="comment-form">
                    <input type="hidden" name="object_id" value="{{$news->id}}">
                    <input type="hidden" name="type" value="2">
                    <div class="form-group w-100 mb-5 d-flex">
                        <h2 class="headingVII text-uppercase mr-5 pt-1">Đánh giá</h2>
                        <ul class="list-unstyled ratingList d-flex flex-nowrap mb-2 comment-rating">
                            <input type="hidden" name="rating" value="0">
                            <li class="mr-2"><a href="javascript:void(0);" data-id="star-1" class="star"><i class="far fa-star"></i></a></li>
                            <li class="mr-2"><a href="javascript:void(0);" data-id="star-2" class="star"><i class="far fa-star"></i></a></li>
                            <li class="mr-2"><a href="javascript:void(0);" data-id="star-3" class="star"><i class="far fa-star"></i></a></li>
                            <li class="mr-2"><a href="javascript:void(0);" data-id="star-4" class="star"><i class="far fa-star"></i></a></li>
                            <li class="mr-2"><a href="javascript:void(0);" data-id="star-5" class="star"><i class="far fa-star"></i></a></li>
                        </ul>
                    </div>
                    
                    <div class="form-group w-100 mb-5">
                        <textarea class="form-control" placeholder="bình luận" name="comment"></textarea>
                    </div>
                    <div class="d-flex flex-wrap row1 mb-md-5">
                        <div class="form-group coll mb-5">
                            <label for="name" class="mb-1">Họ và tên *</label>
                            <input type="text" id="name" class="form-control" name="customer_name">
                        </div>
                        <div class="form-group coll mb-5">
                            <label for="email" class="mb-1">Email *</label>
                            <input type="email" class="form-control" id="email" name="customer_email">
                        </div>
                        <div class="form-group coll mb-5">
                            <label for="website" class="mb-1">Website</label>
                            <input type="text" class="form-control" id="website" name="customer_website">
                        </div>
                    </div>
                    <button class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4" id="comment-btn" data-object-id="{{$news->id}}">
                        Bình luận<i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/web/blog/detail.js')}}"></script>
@endsection
