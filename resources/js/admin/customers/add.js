$(document).ready(function () {
  $('.custom-select-2').select2({
    placeholder: "Select a option",
  });

  $('.select-tags').select2({
    placeholder: "",
    tags: true,
    tokenSeparators: [',']
  });
  
  $('#province-id').on('select2:select', function (e) {
    var data = e.params.data;
    provinceId = data.id;

    // load district by province
    $.ajax({
      url: `/provinces/${provinceId}`,
      type: 'GET',
      loading: true,
      success: function (response) {
        $('#district-id').html(response.data['district-options']);
        $('#ward-id').html('');
      },
      error: function (jqXHR, textStatus, errorThrown) {

      }
    });
  });

  $('#district-id').on('select2:select', function (e) {
    var data = e.params.data;
    districtId = data.id;

    // load ward by district
    $.ajax({
      url: `/districts/${districtId}`,
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
