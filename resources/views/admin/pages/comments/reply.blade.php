<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-reply-comment-label">Trả lời bình luận</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-reply-comment">
                <input type="hidden" name="comment_parent" value="{{$comment->id}}" />
                <input type="hidden" name="type" value="{{$comment->type}}" />
                <input type="hidden" name="object_id" value="{{$comment->object_id}}" />
                <input type="hidden" name="status" value="1" />
                @csrf
                <div class="form-group row">
                    <div class="col-12">
                        <textarea class="form-control" rows="5" name="comment"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" id="reply-comment">Trả lời</button>
        </div>
    </div>
</div>