$(document).ready(function () {
  $('.custom-select-2').select2({
    placeholder: "Select a option",
  });

  $('.select-tags').select2({
    placeholder: "",
    tags: true,
    tokenSeparators: [',', ' ']
  });

  $('#categories-image-remove').click(function () {
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');
    target_input.value = "";
    target_preview.src = "/assets/images/no-image.png"
  })

  $('#image-preview').click(function () {
    var route_prefix = '/filemanager';
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');

    window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      var file_path = items.map(function (item) {
        return item.url;
      }).join(',');
      
      // set the value of the desired input to image url
      target_input.value = file_path;
      target_input.dispatchEvent(new Event('change'));

      // clear previous preview
      target_preview.src = file_path;

      // trigger change event
      target_preview.dispatchEvent(new Event('change'));
    };
  })
})
