<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Hình ảnh</th>
        <th scope="col" class="font-weight-bold">Tên</th>
        <th scope="col" class="font-weight-bold">Cấp cha</th>
        <th scope="col" class="font-weight-bold">Hiển thị ở trang chủ</th>
        <th scope="col" class="font-weight-bold">Trạng thái</th>
        <th scope="col" data-sort-by="sort"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'sort' ? 'sorting--'.request()->get('order_by') : ''}}">
            Thứ tự
        </th>
        <th scope="col" data-sort-by="products_count"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'products_count' ? 'sorting--'.request()->get('order_by') : ''}}">
            Sản phẩm
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
    @forelse ($categories as $category)
        <tr>
            <td scope="row">{{($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration}}</td>
            <td>
            <img src="{{asset('storage'.$category['image'])}}" alt="{{$category['title']}}"
                     onerror="this.src='https://admin.cobtainlife.tk/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>{{$category['title']}}</td>
            <td>{{$category['parents']['title'] ?? \App\Enums\Constant::NO_PARENT}}</td>
            <td>
                <span class="badge text-white font-weight-bold bg-{{$category['top'] == 1 ? 'success' : 'danger'}}">
                    {{$category['top'] == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>
            <span class="badge text-white font-weight-bold bg-{{$category['status'] == 1 ? 'success' : 'danger'}}">
                    {{$category['status'] == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>{{$category['sort']}}</td>
            <td>
                <a href="#">{{$category['products_count']}}</a>
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($category['created_at']))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($category['updated_at']))}}</td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.categories.edit', ['category' => $category['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-category"
                        data-category-id="{{$category['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$categories->total() > ($categories->currentPage() - 1) * $categories->perPage() ? ($categories->currentPage() - 1) * $categories->perPage() + 1 : 0}} đến
        {{$categories->total() < ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage() ? $categories->total() : ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage()}}
        của
        {{$categories->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$categories->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
