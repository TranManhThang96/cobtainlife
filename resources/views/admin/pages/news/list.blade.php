<table class="table table-bordered">
    <thead>
        <tr class="thead--row">
            <th scope="col" class="font-weight-bold">#</th>
            <th scope="col" class="font-weight-bold">Hình ảnh</th>
            <th scope="col" class="font-weight-bold">Tiêu đề</th>
            <th scope="col" class="font-weight-bold">Trạng thái</th>
            <th scope="col" class="font-weight-bold">Tags</th>
            <th scope="col" data-sort-by="sort" class="font-weight-bold sorting {{request()->get('sort_by') === 'sort' ? 'sorting--'.request()->get('order_by') : ''}}">
                Thứ tự
            </th>
            <th scope="col" data-sort-by="created_at" class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}">
                Thời gian tạo
            </th>
            <th scope="col" data-sort-by="updated_at" class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}">
                Thời gian cập nhật
            </th>
            <th scope="col" class="font-weight-bold">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($listNews as $news)
        <tr>
            <td scope="row">{{($listNews->currentPage() - 1) * $listNews->perPage() + $loop->iteration}}</td>
            <td>
                <img src="{{asset('storage'.$news->image)}}" alt="{{$news->title}}" onerror="this.src='https://{{config('app.subdomain_admin')}}/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>{{$news->title}}</td>
            <td>
                <span class="badge text-white font-weight-bold bg-{{$news['status'] == 1 ? 'success' : 'danger'}}">
                    {{$news['status'] == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>
                @foreach($news->tags as $tag)
                    <span
                        class="news-tag {{request()->tag_id == $tag->id ? 'news-tag-searched' : ''}}">{{$tag->label}}</span>
                @endforeach
            </td>
            <td>{{$news['sort']}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($news->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($news->updated_at))}}</td>
            <td>
                <a class="btn btn-cyan btn-sm" href="{{route('admin.news.edit', ['news' => $news['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-news" data-news-id="{{$news['id']}}">Xóa</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$listNews->total() > ($listNews->currentPage() - 1) * $listNews->perPage() ? ($listNews->currentPage() - 1) * $listNews->perPage() + 1 : 0}} đến
        {{$listNews->total() < ($listNews->currentPage() - 1) * $listNews->perPage() + $listNews->perPage() ? $listNews->total() : ($listNews->currentPage() - 1) * $listNews->perPage() + $listNews->perPage()}}
        của
        {{$listNews->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$listNews->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>