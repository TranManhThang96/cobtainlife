$(document).ready(function () {
  let modalAddLengthClass = $('#modal-add-length-class');
  let modalEditLengthClass = $('#modal-edit-length-class');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-length-class', function () {
    let lengthClassId = $(this).data('length-class-id');
    $.ajax({
      url: `/length-class/${lengthClassId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditLengthClass.html(response.data).modal('show');
        modalAddLengthClass.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-length-class', function () {
    $('.page-loading').fadeIn();
    let lengthClassId = $('#form-edit-length-class #length-class-id').val();
    $.ajax({
      url: `/length-class/${lengthClassId}`,
      type: 'put',
      data: $('#form-edit-length-class').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditLengthClass.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/length-class/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-length-class');
        } else {
          modalEditLengthClass.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

