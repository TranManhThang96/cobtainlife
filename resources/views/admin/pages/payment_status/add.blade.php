<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-add-payment-status-label">Thêm trạng thái</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-add-payment-status">
                <input type="hidden" id="payment-status-id" value=""/>
                @csrf
                <div class="form-group row">
                    <label for="input-payment-status-name"
                           class="col-sm-3 col-form-label">Trạng thái</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-payment-status-name" name="name">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary"
                    id="add-payment-status">Lưu</button>
        </div>
    </div>
</div>
