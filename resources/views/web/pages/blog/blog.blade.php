@extends('web.layout.full')

@section('content')
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url({{asset('dist/images/1920x300.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
                <h1 class="headingIV fwEbold playfair mb-4">Tin Tức</h1>
                <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                    <li class="mr-2"><a href="{{route('web.home')}}">Trang Chủ</a></li>
                    <li class="mr-2">/</li>
                    <li class="active">Tin Tức</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- twoColumns -->
<div class="twoColumns container pt-lg-23 pb-lg-20 pt-md-16 pb-md-4 pt-10 pb-4">
    <div class="row">
        <div class="col-12 col-lg-9 order-lg-3">
            <!-- content -->
            <article id="content">
                @foreach($listNews as $news)
                    <!-- newsBlogColumn -->
                    <div class="newsBlogColumn mb-md-9 mb-6">
                        <div class="imgHolder position-relative mb-6">
                            <a href="{{route('web.blog.show', ['blog' => $news->alias])}}">
                                <img src="{{asset('storage'.$news->image)}}" alt="{{$news->name}}" onerror='this.src="{{asset('dist/images/870x450.png')}}"' width="870px" height="450px">
                            </a>
                        </div>
                        <div class="textHolder d-flex align-items-start">
                            <time class="time text-center text-uppercase py-sm-3 py-1 px-1" datetime="{{$news->created_at}}"> 
                                <strong class="fwEbold d-block mb-1">{{readDateTime($news->created_at, 'd')}}</strong> {{readDateTime($news->created_at, 'M')}}
                            </time>
                            <div class="alignLeft pl-sm-6 pl-3">
                                <h2 class="headingV fwEbold mb-2"><a href="{{route('web.blog.show', ['blog' => $news->alias])}}">{{$news->title ?? ''}}</a></h2>
                                <span class="postBy d-block pb-sm-6 pb-2 mb-3">Đăng bởi: <a href="{{route('web.blog.show', ['blog' => $news->alias])}}">Cobtainlife</a></span>
                                <p class="d-inline-block text-truncate" style="max-width: 40vw">{{$news->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 mb-sm-0 mb-6">
                    {{$listNews->links('vendor.pagination.cobtainlife')}}
                </div>
            </article>
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
                <section class="widget overflow-hidden mb-md-6 mb-3">
                    <h3 class="headingVII fwEbold text-uppercase mb-4">Lưu trữ</h3>
                    <ul class="list-unstyled archiveList mb-0">
                        @foreach($archives as $archive)
                            <li class="mb-3"><a href="{{route('web.blog.type', ['type' => 'date', 'value' => $archive->new_date])}}" class="d-block">{{getMonth($archive->month)}} - {{$archive->year}}</a></li>
                        @endforeach
                    </ul>
                </section>
                <!-- widget -->
                <section class="widget mb-9">
                        <h3 class="headingVII fwEbold text-uppercase mb-5">tags</h3>
                        <ul class="list-unstyled tagNavList d-flex flex-wrap mb-0">
                            @foreach($tags as $tag)
                                <li class="text-center"><a href="{{route('web.blog.type', ['type' => 'tags', 'value' => $tag->alias])}}" class="md-round d-block">{{$tag->label}}</a></li>
                            @endforeach
                        </ul>
                    </section>
            </aside>
        </div>
    </div>
</div>
@endsection