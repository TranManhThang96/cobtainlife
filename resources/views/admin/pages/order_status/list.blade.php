<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Tên</th>
        <th scope="col" class="font-weight-bold">Đơn hàng</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($listOrderStatus as $orderStatus)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$orderStatus['name']}}</td>
            <td>
                @if ($orderStatus['orders_count'] > 0)
                    <a href="{{route('admin.orders.index', ['status' => $orderStatus['id']])}}">
                        {{$orderStatus['orders_count']}}
                    </a>
                @else
                    {{$orderStatus['orders_count']}}
                @endif
            </td>
            <td>
                <button class="btn btn-cyan btn-sm btn-edit-order-status"
                    data-order-status-id="{{$orderStatus['id']}}">Sửa
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-order-status"
                data-order-status-id="{{$orderStatus['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
