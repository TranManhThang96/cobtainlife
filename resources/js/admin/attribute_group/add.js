$(document).ready(function () {
  let modalAddAttributeGroup = $('#modal-add-attribute-group');
  let modalEditAttributeGroup = $('#modal-edit-attribute-group');

  // handle when btn add click
  $('#btn-add-attribute-group').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/attribute-group/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddAttributeGroup.html(response.data).modal('show');
        modalEditAttributeGroup.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save click
  $(document).on('click', '#add-attribute-group', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/attribute-group',
      type: 'post',
      data: $('#form-add-attribute-group').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddAttributeGroup.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/attribute-group/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-attribute-group');
        } else {
          modalAddAttributeGroup.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
