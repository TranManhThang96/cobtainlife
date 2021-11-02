<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Hình ảnh</th>
        <th scope="col" class="font-weight-bold">Nhãn hiệu</th>
        <th scope="col" class="font-weight-bold">Thứ tự</th>
        <th scope="col" class="font-weight-bold">Sản phẩm</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($brands as $brand)
        <tr>
            <td scope="row">{{($brands->currentPage() - 1) * $brands->perPage() + $loop->iteration}}</td>
            <td>
            <img src="{{asset('storage'.$brand->image)}}" alt="{{$brand->name}}"
                     onerror="this.src='https://{{config('app.subdomain_admin')}}/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>{{$brand->name}}</td>
            <td>{{$brand->sort}}</td>
            <td>
                <a href="#">{{$brand->products_count}}</a>
            </td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.brands.edit', ['brand' => $brand['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-brand"
                        data-brand-id="{{$brand['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$brands->total() > ($brands->currentPage() - 1) * $brands->perPage() ? ($brands->currentPage() - 1) * $brands->perPage() + 1 : 0}} đến
        {{$brands->total() < ($brands->currentPage() - 1) * $brands->perPage() + $brands->perPage() ? $brands->total() : ($brands->currentPage() - 1) * $brands->perPage() + $brands->perPage()}}
        của
        {{$brands->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$brands->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
