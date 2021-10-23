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
    @forelse ($listWeightClass as $weightClass)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$weightClass['name']}}</td>
            <td>
                {{$weightClass['description']}}
            </td>
            <td>
                <button class="btn btn-cyan btn-sm btn-edit-weight-class"
                    data-weight-class-id="{{$weightClass['id']}}">Sửa
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-weight-class"
                data-weight-class-id="{{$weightClass['id']}}">Xóa</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
