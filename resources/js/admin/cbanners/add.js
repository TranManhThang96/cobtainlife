$(document).ready(function () {
  $('#banner-image-remove').click(function () {
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');
    target_input.value = "";
    target_preview.src = "/assets/images/no-image.png"
  })

  $('#image-preview').click(function () {
    let route_prefix = '/filemanager';
    let target_input = document.getElementById('image-input');
    let target_preview = document.getElementById('image-preview');

    window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      let file_path = items.map(function (item) {
        return item.url;
      }).join(',');

      let file_path_short = file_path.split('storage');

      // set the value of the desired input to image url
      target_input.value = file_path_short[1];
      target_input.dispatchEvent(new Event('change'));

      // clear previous preview
      target_preview.src = file_path;

      // trigger change event
      target_preview.dispatchEvent(new Event('change'));
    };
  })
})
