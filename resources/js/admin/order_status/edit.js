$(document).ready(function () {
  let modalAddOrderStatus = $('#modal-add-order-status');
  let modalEditOrderStatus = $('#modal-edit-order-status');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-order-status', function () {
    let orderStatusId = $(this).data('order-status-id');
    $.ajax({
      url: `/order-status/${orderStatusId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditOrderStatus.html(response.data).modal('show');
        modalAddOrderStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-order-status', function () {
    $('.page-loading').fadeIn();
    let orderStatusId = $('#form-edit-order-status #order-status-id').val();
    $.ajax({
      url: `/order-status/${orderStatusId}`,
      type: 'put',
      data: $('#form-edit-order-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditOrderStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/order-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-order-status');
        } else {
          modalEditOrderStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

