$(document).ready(function () {
  let modalAddLengthClass = $('#modal-add-length-class');
  let modalEditLengthClass = $('#modal-edit-length-class');

  // handle when btn add click
  $('#btn-add-length-class').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/length-class/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddLengthClass.html(response.data).modal('show');
        modalEditLengthClass.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-length-class', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/length-class',
      type: 'post',
      data: $('#form-add-length-class').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddLengthClass.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/length-class/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-length-class');
        } else {
          modalAddLengthClass.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
