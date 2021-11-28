<form id="config-comment-frm" method="POST">
    @csrf
    <input type="hidden" name="code" value="comment">
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label class="col-sm-6 text-right font-weight-bold">Cho phép bình luận</label>
                <div class="col-sm-6">
                    <label class="switch">
                        <input type="checkbox" name="comment_enable" value="1" {{($configs->comment_enable['value'] ?? '') == 1 ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-6 text-right font-weight-bold">Ẩn bình luận đánh giá thấp (dưới 3 sao)</label>
                <div class="col-sm-6">
                    <label class="switch">
                        <input type="checkbox" name="comment_auto_hide" value="1" {{($configs->comment_auto_hide['value'] ?? '') == 1 ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <button type="reset" class="btn btn-info mr-2">Reset</button>
                <button type="submit" class="btn btn-success btn-save-config" data-form="config-comment-frm">Lưu</button>
            </div>
        </div>
    </div>
</form>