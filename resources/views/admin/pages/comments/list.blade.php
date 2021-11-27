<table class="table table-bordered">
    <thead>
        <tr class="thead--row">
            <th scope="col" class="font-weight-bold">#</th>
            <th scope="col" class="font-weight-bold">Link</th>
            <th scope="col" class="font-weight-bold">Tên khách hàng</th>
            <th scope="col" class="font-weight-bold">Email</th>
            <th scope="col" class="font-weight-bold">Website</th>
            <th scope="col" class="font-weight-bold">Đánh giá</th>
            <th scope="col" class="font-weight-bold">Bình luận</th>
            <th scope="col" class="font-weight-bold">Trạng thái</th>
            <th scope="col" class="font-weight-bold">Thời gian</th>
            <th scope="col" class="font-weight-bold">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($comments as $comment)
        <tr>
            <td scope="row">{{($comments->currentPage() - 1) * $comments->perPage() + $loop->iteration}}</td>
            <td>
                <a href="{{$comment->type == \App\Enums\DBConstant::NEWS_COMMENT ? 
                    route('web.blog.show', ['blog' => $comment->news->alias ?? '']) : 
                    route('web.products.show', ['product' => $comment->product->alias ?? ''])}}" target="_blank">Link</a>
            </td>
            <td>
                {{$comment->customer_name}}
            </td>
            <td>{{$comment->customer_email}}</td>
            <td>{{$comment->customer_website}}</td>
            <td>
                @if ($comment->rating > 0)
                    <div class="d-flex flex-nowrap comment-rating">
                        @foreach([1,2,3,4,5] as $star)
                            @if ($star > $comment->rating)
                                <i class="far fa-star mr-1"></i>
                            @else
                                <i class="fas fa-star mr-1"></i>
                            @endif
                        @endforeach
                    </div>
                @endif
            </td>
            <td>{!! $comment->comment !!}</td>
            <td>
                <span class="badge text-white bg-{{$comment->status == \App\Enums\DBConstant::SHOW_COMMENT ? 'success' : 'danger'}}">
                    {{$comment->status == \App\Enums\DBConstant::SHOW_COMMENT ? 'Hiện' : 'Ẩn'}}
                </span>
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($comment['created_at']))}}</td>
            <td class="d-flex">
                <button type="button" class="btn btn-cyan btn-sm btn-reply-comment mr-1" data-comment-id="{{$comment->id}}">
                    Trả lời
                    <span class="badge {{$comment->child_count > 0 ? 'badge-dark' : 'badge-danger'}}">{{$comment->child_count}}</span>
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-hidden-comment" data-comment-id="{{$comment->id}}">Ẩn</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$comments->total() > ($comments->currentPage() - 1) * $comments->perPage() ? ($comments->currentPage() - 1) * $comments->perPage() + 1 : 0}} đến
        {{$comments->total() < ($comments->currentPage() - 1) * $comments->perPage() + $comments->perPage() ? $comments->total() : ($comments->currentPage() - 1) * $comments->perPage() + $comments->perPage()}}
        của
        {{$comments->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$comments->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>