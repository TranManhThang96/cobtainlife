<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-add-tax-label">Thêm thuế</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-add-tax">
                <input type="hidden" id="tax-id" value=""/>
                @csrf
                <div class="form-group row">
                    <label for="input-tax-name"
                           class="col-sm-3 col-form-label">Tên</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-tax-name" name="name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input-tax-name"
                           class="col-sm-3 col-form-label">Giá trị</label>
                    <div class="col-sm-9">
                    <input type="number" max="100" min="0" class="form-control" name="value">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary"
                    id="add-tax">Lưu</button>
        </div>
    </div>
</div>
