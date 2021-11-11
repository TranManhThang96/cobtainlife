$(document).ready(function() {
  $('#comment-btn').click(function (e) {
    e.preventDefault();
    $.ajax({
      url: `/comments`,
      type: 'POST',
      loading: true,
      data: $('#comment-form').serialize(),
      success: function (response) {
        toastr.success(response.msg);
        setTimeout(() => {
          window.location.reload();
        }, 1000)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#comment-form');
        } else {
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  });
});