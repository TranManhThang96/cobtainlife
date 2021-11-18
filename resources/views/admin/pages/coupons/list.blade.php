<table class="table table-bordered">
    <thead>
        <tr class="thead--row">
            <th scope="col" class="font-weight-bold">#</th>
            <th scope="col" class="font-weight-bold">Tên</th>
            <th scope="col" class="font-weight-bold">Mã code</th>
            <th scope="col" data-sort-by="value" class="font-weight-bold sorting {{request()->get('sort_by') === 'value' ? 'sorting--'.request()->get('order_by') : ''}}">Giá trị (%)</th>
            <th scope="col" data-sort-by="max_discount" class="font-weight-bold sorting {{request()->get('sort_by') === 'max_discount' ? 'sorting--'.request()->get('order_by') : ''}}">Giảm giá tối đa</th>
            <th scope="col" data-sort-by="max_applied" class="font-weight-bold sorting {{request()->get('sort_by') === 'max_applied' ? 'sorting--'.request()->get('order_by') : ''}}">Số lượt tối đa</th>
            <th scope="col" data-sort-by="applied" class="font-weight-bold sorting {{request()->get('sort_by') === 'applied' ? 'sorting--'.request()->get('order_by') : ''}}">Đã sử dụng</th>
            <th scope="col" data-sort-by="start" class="font-weight-bold sorting {{request()->get('sort_by') === 'start' ? 'sorting--'.request()->get('order_by') : ''}}">
                Ngày bắt đầu
            </th>
            <th scope="col" data-sort-by="end" class="font-weight-bold sorting {{request()->get('sort_by') === 'end' ? 'sorting--'.request()->get('order_by') : ''}}">
                Ngày kết thúc
            </th>
            <th scope="col" class="font-weight-bold">Trạng thái</th>
            <th scope="col" class="font-weight-bold">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($coupons as $coupon)
        <tr>
            <td scope="row">{{($coupons->currentPage() - 1) * $coupons->perPage() + $loop->iteration}}</td>
            <td>
                {{$coupon->name}}
            </td>
            <td>{{$coupon->code}}</td>
            <td class="text-right">{{$coupon->value}}</td>
            <td class="text-right">
                {{number_format($coupon->max_discount, 0)}}
            </td>
            <td class="text-right">
                {{$coupon->max_applied ?? 0}}
            </td>
            <td class="text-right">
                {{$coupon->applied ?? 0}}
            </td>

            <td>
                @if ($coupon->start)
                {{date('d/m/Y', strtotime($coupon->start))}}
                @endif
            </td>
            <td>
                @if ($coupon->end)
                {{date('d/m/Y', strtotime($coupon->end))}}
                @endif
            </td>
            <td>
                <span class="badge text-white font-weight-bold bg-{{$coupon->status == 1 ? 'success' : 'danger'}}">
                    {{$coupon->status == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>
                <a class="btn btn-cyan btn-sm" href="{{route('admin.coupons.edit', ['coupon' => $coupon->id])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-coupon" data-coupon-id="{{$coupon->id}}">Xóa</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="12" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$coupons->total() > ($coupons->currentPage() - 1) * $coupons->perPage() ? ($coupons->currentPage() - 1) * $coupons->perPage() + 1 : 0}} đến
        {{$coupons->total() < ($coupons->currentPage() - 1) * $coupons->perPage() + $coupons->perPage() ? $coupons->total() : ($coupons->currentPage() - 1) * $coupons->perPage() + $coupons->perPage()}}
        của
        {{$coupons->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$coupons->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>