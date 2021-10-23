$(document).ready(function () {
  let modalAddPaymentStatus = $('#modal-add-payment-status');
  let modalEditPaymentStatus = $('#modal-edit-payment-status');

  // handle when btn add click
  $('#btn-add-payment-status').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/payment-status/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddPaymentStatus.html(response.data).modal('show');
        modalEditPaymentStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-payment-status', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/payment-status',
      type: 'post',
      data: $('#form-add-payment-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddPaymentStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/payment-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-payment-status');
        } else {
          modalAddPaymentStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
