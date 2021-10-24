$(document).ready(function () {
  let modalAddPaymentStatus = $('#modal-add-payment-status');
  let modalEditPaymentStatus = $('#modal-edit-payment-status');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-payment-status', function () {
    let paymentStatusId = $(this).data('payment-status-id');
    $.ajax({
      url: `/payment-status/${paymentStatusId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditPaymentStatus.html(response.data).modal('show');
        modalAddPaymentStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-payment-status', function () {
    $('.page-loading').fadeIn();
    let paymentStatusId = $('#form-edit-payment-status #payment-status-id').val();
    $.ajax({
      url: `/payment-status/${paymentStatusId}`,
      type: 'put',
      data: $('#form-edit-payment-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditPaymentStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/payment-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-payment-status');
        } else {
          modalEditPaymentStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

