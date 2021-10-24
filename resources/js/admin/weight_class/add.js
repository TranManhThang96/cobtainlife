$(document).ready(function () {
  let modalAddWeightClass = $('#modal-add-weight-class');
  let modalEditWeightClass = $('#modal-edit-weight-class');

  // handle when btn add click
  $('#btn-add-weight-class').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/weight-class/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddWeightClass.html(response.data).modal('show');
        modalEditWeightClass.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-weight-class', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/weight-class',
      type: 'post',
      data: $('#form-add-weight-class').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddWeightClass.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/weight-class/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-weight-class');
        } else {
          modalAddWeightClass.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
