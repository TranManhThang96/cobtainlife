$(document).ready(function () {
  let modalAddShippingStatus = $('#modal-add-shipping-status');
  let modalEditShippingStatus = $('#modal-edit-shipping-status');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-shipping-status', function () {
    let shippingStatusId = $(this).data('shipping-status-id');
    $.ajax({
      url: `/shipping-status/${shippingStatusId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditShippingStatus.html(response.data).modal('show');
        modalAddShippingStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-shipping-status', function () {
    $('.page-loading').fadeIn();
    let shippingStatusId = $('#form-edit-shipping-status #shipping-status-id').val();
    $.ajax({
      url: `/shipping-status/${shippingStatusId}`,
      type: 'put',
      data: $('#form-edit-shipping-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditShippingStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/shipping-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-shipping-status');
        } else {
          modalEditShippingStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

