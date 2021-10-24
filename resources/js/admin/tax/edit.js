$(document).ready(function () {
  let modalAddTax = $('#modal-add-tax');
  let modalEditTax = $('#modal-edit-tax');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-tax', function () {
    let taxId = $(this).data('tax-id');
    $.ajax({
      url: `/tax/${taxId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditTax.html(response.data).modal('show');
        modalAddTax.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-tax', function () {
    $('.page-loading').fadeIn();
    let taxId = $('#form-edit-tax #tax-id').val();
    $.ajax({
      url: `/tax/${taxId}`,
      type: 'put',
      data: $('#form-edit-tax').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditTax.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/tax/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-tax');
        } else {
          modalEditTax.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

