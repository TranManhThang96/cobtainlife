<table class="table table-bordered">
    <thead>
        <tr class="thead--row">
            <th scope="col" class="font-weight-bold">#</th>
            <th scope="col" class="font-weight-bold">Tên khách hàng</th>
            <th scope="col" class="font-weight-bold">Số điện thoại</th>
            <th scope="col" class="font-weight-bold">Email</th>
            <th scope="col" class="font-weight-bold">Giới tính</th>
            <th scope="col" class="font-weight-bold">Địa chỉ</th>
            <th scope="col" class="font-weight-bold">Đơn hàng</th>
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
        @forelse ($customers as $customer)
        <tr>
            <td scope="row">{{($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration}}</td>
            <td>
                {{$customer->name}}
            </td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->sex == 1 ? 'Nam' : 'Nữ'}}</td>
            <td>
                {{$customer->address ?? ''}}, {{$customer->ward->prefix ?? ''}} {{$customer->ward->name ?? ''}}, {{$customer->district->prefix ?? ''}} {{$customer->district->name ?? ''}}, {{$customer->province->name ?? ''}}
            </td>
            <td class="text-right">
                <a href="{{route('admin.orders.index', ['customer_id' => $customer->id])}}">{{$customer->orders_count ?? 0}}</a>
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($customer['created_at']))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($customer['updated_at']))}}</td>
            <td>
                <a class="btn btn-cyan btn-sm" href="{{route('admin.customers.edit', ['customer' => $customer['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-customer" data-customer-id="{{$customer['id']}}">Xóa</button>
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
        Hiển thị {{$customers->total() > ($customers->currentPage() - 1) * $customers->perPage() ? ($customers->currentPage() - 1) * $customers->perPage() + 1 : 0}} đến
        {{$customers->total() < ($customers->currentPage() - 1) * $customers->perPage() + $customers->perPage() ? $customers->total() : ($customers->currentPage() - 1) * $customers->perPage() + $customers->perPage()}}
        của
        {{$customers->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$customers->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>