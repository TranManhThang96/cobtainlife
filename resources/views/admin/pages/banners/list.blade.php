<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Hình ảnh</th>
        <th scope="col" class="font-weight-bold">Trạng thái</th>
        <th scope="col" data-sort-by="sort"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'sort' ? 'sorting--'.request()->get('order_by') : ''}}">
            Thứ tự
        </th>
        <th scope="col" data-sort-by="created_at"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}">
            Thời gian tạo
        </th>
        <th scope="col" data-sort-by="updated_at"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}">
            Thời gian cập nhật
        </th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($banners as $banner)
        <tr>
            <td scope="row">{{($banners->currentPage() - 1) * $banners->perPage() + $loop->iteration}}</td>
            <td>
            <img src="{{asset('storage'.$banner['image'])}}" alt="banner"
                     onerror="this.src='https://admin.cobtainlife.tk/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>
            <span class="badge text-white font-weight-bold bg-{{$banner['status'] == 1 ? 'success' : 'danger'}}">
                    {{$banner['status'] == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>{{$banner['sort']}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($banner['created_at']))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($banner['updated_at']))}}</td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.banners.edit', ['banner' => $banner['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-banner"
                        data-banner-id="{{$banner['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$banners->total() > ($banners->currentPage() - 1) * $banners->perPage() ? ($banners->currentPage() - 1) * $banners->perPage() + 1 : 0}} đến
        {{$banners->total() < ($banners->currentPage() - 1) * $banners->perPage() + $banners->perPage() ? $banners->total() : ($banners->currentPage() - 1) * $banners->perPage() + $banners->perPage()}}
        của
        {{$banners->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$banners->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
