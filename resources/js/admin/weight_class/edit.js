$(document).ready(function () {
  let modalAddWeightClass = $('#modal-add-weight-class');
  let modalEditWeightClass = $('#modal-edit-weight-class');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-weight-class', function () {
    let weightClassId = $(this).data('weight-class-id');
    $.ajax({
      url: `/weight-class/${weightClassId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditWeightClass.html(response.data).modal('show');
        modalAddWeightClass.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-weight-class', function () {
    $('.page-loading').fadeIn();
    let weightClassId = $('#form-edit-weight-class #weight-class-id').val();
    $.ajax({
      url: `/weight-class/${weightClassId}`,
      type: 'put',
      data: $('#form-edit-weight-class').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditWeightClass.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/weight-class/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-weight-class');
        } else {
          modalEditWeightClass.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

