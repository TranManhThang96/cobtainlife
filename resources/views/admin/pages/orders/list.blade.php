<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Khách hàng</th>
        <th scope="col" class="font-weight-bold">Tiền hàng</th>
        <th scope="col" class="font-weight-bold">Vận chuyển</th>
        <th scope="col" data-sort-by="stock"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'stock' ? 'sorting--'.request()->get('order_by') : ''}}">
            Giảm giá
        </th>
        <th scope="col" class="font-weight-bold">Thuế</th>
        <th scope="col" class="font-weight-bold">Tổng tiền</th>
        <th scope="col" class="font-weight-bold">Trạng thái</th>
        <th scope="col" class="font-weight-bold">Tạo lúc</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($orders as $order)
        <tr>
            <td scope="row">{{($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration}}</td>
            <td>
                <span><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;<b>{{$order['customer_name']}}</b></span><br/>
                <span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;{{$order['phone']}}</span><br/>
                <span><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;{{$order['email']}}</span>
            </td>
            <td class="text-right">
                {{number_format($order['subtotal'], 0)}}
            </td>
            <td class="text-right">{{number_format($order['shipping'], 0)}}</td>
            <td class="text-right">{{number_format($order['discount'], 0)}}</td>
            <td class="text-right">{{number_format($order['tax'], 0)}}</td>
            <td class="text-right">{{number_format($order['total'], 0)}}</td>
            <td>{{$order['orderStatus']['name']}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($order['created_at']))}}</td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.orders.edit', ['order' => $order['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-order"
                        data-order-id="{{$order['id']}}">Xóa</button>
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
        Hiển thị {{$orders->total() > ($orders->currentPage() - 1) * $orders->perPage() ? ($orders->currentPage() - 1) * $orders->perPage() + 1 : 0}} đến
        {{$orders->total() < ($orders->currentPage() - 1) * $orders->perPage() + $orders->perPage() ? $orders->total() : ($orders->currentPage() - 1) * $orders->perPage() + $orders->perPage()}}
        của
        {{$orders->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$orders->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
