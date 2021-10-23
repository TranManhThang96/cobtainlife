$(document).ready(function () {
  let modalAddShippingStatus = $('#modal-add-shipping-status');
  let modalEditShippingStatus = $('#modal-edit-shipping-status');

  // handle when btn add click
  $('#btn-add-shipping-status').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/shipping-status/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddShippingStatus.html(response.data).modal('show');
        modalEditShippingStatus.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-shipping-status', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/shipping-status',
      type: 'post',
      data: $('#form-add-shipping-status').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddShippingStatus.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/shipping-status/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-shipping-status');
        } else {
          modalAddShippingStatus.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
