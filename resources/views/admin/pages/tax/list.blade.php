<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Tên</th>
        <th scope="col" class="font-weight-bold">Giá trị</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($listTax as $tax)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$tax['name']}}</td>
            <td>
                {{$tax['value']}}
            </td>
            <td>
                <button class="btn btn-cyan btn-sm btn-edit-tax"
                    data-tax-id="{{$tax['id']}}">Sửa
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-tax"
                data-tax-id="{{$tax['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
