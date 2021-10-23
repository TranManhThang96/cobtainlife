<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-edit-length-class-label">Sửa đơn vị</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-edit-length-class">
                <input type="hidden" id="length-class-id" value="{{$lengthClass['id']}}"/>
                @csrf
                <div class="form-group row">
                    <label for="input-length-class-name"
                           class="col-sm-3 col-form-label">Tên đơn vị</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-length-class-name" name="name" value="{{$lengthClass['name']}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input-length-class-name"
                           class="col-sm-3 col-form-label">Mô tả</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="description" value="{{$lengthClass['description']}}">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary"
                    id="edit-length-class">Lưu</button>
        </div>
    </div>
</div>
