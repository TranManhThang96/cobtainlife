<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Hình ảnh</th>
        <th scope="col" class="font-weight-bold">Tên</th>
        <th scope="col" class="font-weight-bold">Danh mục</th>
        <th scope="col" data-sort-by="price"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'price' ? 'sorting--'.request()->get('order_by') : ''}}">
            Giá
        </th>
        <th scope="col" class="font-weight-bold">Giá khuyến mãi</th>
        <th scope="col" data-sort-by="stock"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'stock' ? 'sorting--'.request()->get('order_by') : ''}}">
            Số lượng trong kho
        </th>
        <th scope="col" class="font-weight-bold">Trạng thái</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($products as $product)
        <tr>
            <td scope="row">{{($products->currentPage() - 1) * $products->perPage() + $loop->iteration}}</td>
            <td>
            <img src="{{asset('storage'.$product['image'])}}" alt="{{$product['name']}}"
                     onerror="this.src='https://admin.cobtainlife.tk/assets/images/no-image.png'" style="max-width: 100px">
            </td>
            <td>{{$product['name']}}</td>
            <td>
                <span>{{$product['category']['title']}}<span>
                <p class="pt-2">
                    <b>SKU: </b>
                    <span>{{$product['sku']}}</span>
                </p>
            </td>
            <td>
                {{number_format($product['price'], 0)}}
            </td>
            <td>
                <span>{{number_format($product['promotion']['price_promotion'] ?? $product['price'], 0)}}</span>
                @if(isset($product['promotion']['start']) && isset($product['promotion']['end']))
                    <p class="pt-2">
                        <span>{{date('d/m/Y', strtotime($product['promotion']['start']))}}</span>
                        <span> - </span>
                        <span>{{date('d/m/Y', strtotime($product['promotion']['end']))}}</span>
                    </p>
                @endif
            </td>
            <td>
                {{$product['stock']}}
            </td>
            <td>
            <span class="badge text-white font-weight-bold bg-{{$product['status'] == 1 ? 'success' : 'danger'}}">
                    {{$product['status'] == 1 ? 'ON' : 'OFF'}}
                </span>
            </td>
            <td>
                <a class="btn btn-cyan btn-sm"
                        href="{{route('admin.products.edit', ['product' => $product['id']])}}">Sửa
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete-product"
                        data-product-id="{{$product['id']}}">Xóa</button>
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
        Hiển thị {{$products->total() > ($products->currentPage() - 1) * $products->perPage() ? ($products->currentPage() - 1) * $products->perPage() + 1 : 0}} đến
        {{$products->total() < ($products->currentPage() - 1) * $products->perPage() + $products->perPage() ? $products->total() : ($products->currentPage() - 1) * $products->perPage() + $products->perPage()}}
        của
        {{$products->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$products->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
