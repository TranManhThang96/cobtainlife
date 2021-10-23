$(document).ready(function () {
  let modalAddTax = $('#modal-add-tax');
  let modalEditTax = $('#modal-edit-tax');

  // handle when btn add click
  $('#btn-add-tax').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/tax/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddTax.html(response.data).modal('show');
        modalEditTax.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-tax', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/tax',
      type: 'post',
      data: $('#form-add-tax').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddTax.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/tax/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-tax');
        } else {
          modalAddTax.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
