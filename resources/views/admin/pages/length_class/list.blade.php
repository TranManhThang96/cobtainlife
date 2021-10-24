<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Tên</th>
        <th scope="col" class="font-weight-bold">Mô tả</th>
        <th scope="col" class="font-weight-bold">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($listLengthClass as $lengthClass)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$lengthClass['name']}}</td>
            <td>
                {{$lengthClass['description']}}
            </td>
            <td>
                <button class="btn btn-cyan btn-sm btn-edit-length-class"
                    data-length-class-id="{{$lengthClass['id']}}">Sửa
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-length-class"
                data-length-class-id="{{$lengthClass['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
