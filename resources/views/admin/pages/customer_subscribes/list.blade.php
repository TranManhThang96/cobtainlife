<table class="table table-bordered">
    <thead>
        <tr class="thead--row">
            <th scope="col" class="font-weight-bold">#</th>
            <th scope="col" class="font-weight-bold">Tên khách hàng</th>
            <th scope="col" class="font-weight-bold">Số điện thoại</th>
            <th scope="col" class="font-weight-bold">Email</th>
            <th scope="col" class="font-weight-bold">Loại</th>
            <th scope="col" class="font-weight-bold">Trạng thái</th>
            <th scope="col" class="font-weight-bold">Lời nhắn</th>
            <th scope="col" data-sort-by="created_at" class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}">
                Thời gian đăng ký
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($customers as $customer)
        <tr>
            <td scope="row">
                <input type="checkbox" data-id="{{$customer->id}}" name="customer-subscribe-checkbox[]">
            </td>
            <td>
                {{$customer->name}}
            </td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->email}}</td>
            <td>
                <span class="badge text-white bg-{{$customer->type == 1 ? 'success' : 'info'}}">
                    {{$customer->type == 1 ? 'Đăng ký' : 'Liên hệ'}}
                </span>
            </td>
            <td>
                <span class="badge text-white bg-{{$customer->status == 1 ? 'success' : 'danger'}}">
                    {{$customer->status == 1 ? 'Đã liên hệ' : 'Mới'}}
                </span>
            </td>
            <td>{{$customer->content}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($customer['created_at']))}}</td>
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
        Hiển thị {{$customers->total() > ($customers->currentPage() - 1) * $customers->perPage() ? ($customers->currentPage() - 1) * $customers->perPage() + 1 : 0}} đến
        {{$customers->total() < ($customers->currentPage() - 1) * $customers->perPage() + $customers->perPage() ? $customers->total() : ($customers->currentPage() - 1) * $customers->perPage() + $customers->perPage()}}
        của
        {{$customers->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$customers->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>