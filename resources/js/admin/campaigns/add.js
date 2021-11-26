$(document).ready(function () {
  $('#campaign-press-mail').on('change', function() {
    const flag = $(this).is(':checked');
    if (flag) {
      $('#campaign-to-types-container').addClass('d-none');
      $('input[name="campaign_to_types[]"]').prop('checked', false);
      $('#campaign-to').removeClass('d-none');
    } else {
      $('#campaign-to-types-container').removeClass('d-none');
      $('#campaign-to').addClass('d-none');
      $('#campaign-to').val('');
    }
  })
})