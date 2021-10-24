$(document).ready(function () {
  let modalAddOrderStatus = $('#modal-add-order-status');
  let modalEditOrderStatus = $('#modal-edit-order-status');

  // handle when btn add click
  $('#btn-add-order-status').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/order-status/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddOrderStatus.html(response.data).modal('show');
        modalEditOrderStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-order-status', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/order-status',
      type: 'post',
      data: $('#form-add-order-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddOrderStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/order-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-order-status');
        } else {
          modalAddOrderStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
