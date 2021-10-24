$(document).ready(function () {
  let modalAddAttributeGroup = $('#modal-add-attribute-group');
  let modalEditAttributeGroup = $('#modal-edit-attribute-group');

  // handle when btn add  click
  $(document).on('click', '.btn-edit-attribute-group', function () {
    let attributeGroupId = $(this).data('attribute-group-id');
    $.ajax({
      url: `/attribute-group/${attributeGroupId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditAttributeGroup.html(response.data).modal('show');
        modalAddAttributeGroup.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save  click
  $(document).on('click', '#edit-attribute-group', function () {
    $('.page-loading').fadeIn();
    let attributeGroupId = $('#form-edit-attribute-group #attribute-group-id').val();
    $.ajax({
      url: `/attribute-group/${attributeGroupId}`,
      type: 'put',
      data: $('#form-edit-attribute-group').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditAttributeGroup.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/attribute-group/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-attribute-group');
        } else {
          modalEditAttributeGroup.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

