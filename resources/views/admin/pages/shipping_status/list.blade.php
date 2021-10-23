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
    @forelse ($listShippingStatus as $shippingStatus)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$shippingStatus['name']}}</td>
            <td>
                {{$shippingStatus['orders_count']}}
            </td>
            <td>
                <button class="btn btn-cyan btn-sm btn-edit-shipping-status"
                    data-shipping-status-id="{{$shippingStatus['id']}}">Sửa
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-shipping-status"
                data-shipping-status-id="{{$shippingStatus['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
