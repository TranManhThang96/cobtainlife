$(document).ready(function() {

  $('#province-id').on('change', function (e) {
    let provinceId = $('#province-id option:selected').val();

    // load district by province
    $.ajax({
      url: `/address/provinces/${provinceId}`,
      type: 'GET',
      loading: true,
      success: function (response) {
        $('#district-id').html(response.data['district-options']);
        $('#ward-id').html('');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
      }
    });
  });

  $('#district-id').on('change', function (e) {
    districtId =$('#district-id option:selected').val();

    // load ward by district
    $.ajax({
      url: `/address/districts/${districtId}`,
      type: 'GET',
      loading: true,
      success: function (response) {
        $('#ward-id').html(response.data['ward-options'])
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
      }
    });
  });
})