$(document).ready(function () {
  // choose image
  $(document).on('click', '.lfm', function () {
    let route_prefix = '/filemanager';
    let inputId = $(this).data('input');
    let previewId = $(this).data('preview');

    window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      let file_path = items.map(function (item) {
        return item.url;
      }).join(',');
      let file_path_short = file_path.split('storage');

      let target_input = document.getElementById(`${inputId}`);

      // set the value of the desired input to image url
      target_input.value = file_path_short[1];
      target_input.dispatchEvent(new Event('change'));

      // add preview image
      $(`#${previewId} img`).attr('src', file_path);
    };
  })

  $('.btn-save-config').click(function(e) {
    e.preventDefault();
    const formId = $(this).data('form');
    $.ajax({
      url: '/configs',
      type: 'post',
      data: $(`#${formId}`).serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        toastr.success(response.msg);
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, `#${formId}`);
        } else {
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })

  $('#btn-add-says').click(function () {
    let rowHtml = `
    <div class="row say-item mt-3">
      <div class="col-8 pl-0">
        <input type="text" name="client_say[]" value="" class="form-control rounded-0 input-sm" placeholder="Nhận xét" />
      </div>
      <div class="col-2">
        <div class="input-group">
          <input type="text" name="client_name[]" value="" class="form-control rounded-0 input-sm" placeholder="Tên" />
        </div>
      </div>
      <div class="col-2">
        <div class="input-group">
          <input type="text" name="client_job[]" value="" class="form-control rounded-0 input-sm" placeholder="Nghề nghiệp" />
          <span title="Remove" class="btn btn-flat btn-danger remove-say">
            <i class="fa fa-times"></i>
          </span>
        </div>
      </div>
    </div>
    `;
    $(`#says`).append(rowHtml);
  })

  $(document).on('click', '.remove-say', function () {
    $(this).closest('.say-item').remove();
  })
})
