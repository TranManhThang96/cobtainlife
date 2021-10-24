<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-add-attribute-group-label">Thêm nhóm thuộc tính</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-add-attribute-group">
                <input type="hidden" id="attribute-group-id" value=""/>
                @csrf
                <div class="form-group row">
                    <label for="input-attribute-group-name"
                           class="col-sm-3 col-form-label">Nhóm thuộc tính</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-attribute-group-name" name="name">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary"
                    id="add-attribute-group">Lưu</button>
        </div>
    </div>
</div>
