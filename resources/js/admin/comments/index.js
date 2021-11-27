$(document).ready(function () {
  $(document).on('change', '#select-per-page', function () {
    $('#frm-search input[name="page"]').val(1);
    $('#frm-search input[name="per_page"]').val($(this).val());
    getLists('/comments/search');
  })

  //hidden
  $(document).on('click', '.btn-hidden-comment', function () {
    let commentId = $(this).data('comment-id');
    modalConfirm().then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: `/comments/${commentId}`,
          type: 'PUT',
          loading: true,
          data: {status: 0},
          success: function (response) {
            toastr.success(response.msg);
            getLists('/comments/search');
          },
          error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(jqXHR.responseJSON.userMsg);
          }
        });
      }
    })
  })

  // handle when btn add reply click
  $(document).on('click', '.btn-reply-comment', function () {
    let commentId = $(this).data('comment-id');
    $.ajax({
      url: `/comments/${commentId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        $('#modal-reply-comment').html(response.data).modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when reply
  $(document).on('click', '#reply-comment', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: `/comments/reply`,
      type: 'post',
      data: $('#form-reply-comment').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        $('#modal-reply-comment').modal('hide');
        getLists('/comments/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        toastr.error(jqXHR.responseJSON.userMsg);
      }
    });
  })

})
