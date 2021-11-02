<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Hình ảnh</th>
        <th scope="col" class="font-weight-bold">Tên nhà cung cấp</th>
        <th scope="col" class="font-weight-bold">Số điện thoại</th>
        <th scope="col" class="font-weight-bold">Website</th>
        <th scope="col" class="font-weight-bold">Email</th>
        <th scope="col" class="font-weight-bold">Địa chỉ</th>
        <th scope="col" class="font-weight-bold">Sản phẩm</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($suppliers as $supplier)
        <tr>
            <td scope="row">{{($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration}}</td>
            <td>
            <img src="{{asset('storage'.$supplier->image)}}" alt="{{$supplier['name']}}"
                     onerror="this.src='https://{{config('app.subdomain_admin')}}/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->phone}}</td>
            <td>{{$supplier->url}}</td>
            <td>{{$supplier->email}}</td>
            <td>{{$supplier->address}}</td>
            <td>
                <a href="#">{{$supplier->products_count}}</a>
            </td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.suppliers.edit', ['supplier' => $supplier['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-supplier"
                        data-supplier-id="{{$supplier['id']}}">Xóa</button>
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
        Hiển thị {{$suppliers->total() > ($suppliers->currentPage() - 1) * $suppliers->perPage() ? ($suppliers->currentPage() - 1) * $suppliers->perPage() + 1 : 0}} đến
        {{$suppliers->total() < ($suppliers->currentPage() - 1) * $suppliers->perPage() + $suppliers->perPage() ? $suppliers->total() : ($suppliers->currentPage() - 1) * $suppliers->perPage() + $suppliers->perPage()}}
        của
        {{$suppliers->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$suppliers->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
