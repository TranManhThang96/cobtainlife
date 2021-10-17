tinymce.init({
  selector: 'textarea#editor_content',
  plugins: `advlist autolink lists link image charmap print preview anchor
  searchreplace visualblocks code fullscreen
  insertdatetime media table paste code help wordcount`,
  menubar: 'file edit view insert format tools table tc help',
  toolbar: `undo redo |
  bold italic underline strikethrough |
  fontselect fontsizeselect formatselect |
  alignleft aligncenter alignright alignjustify |
  image |
  outdent indent |
  numlist bullist checklist |
  forecolor backcolor casechange permanentpen formatpainter removeformat | help |`,
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  content_css: ['/assets/libs/prism/prism.css'],
  file_picker_callback: function (callback, value, meta) {
    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

    let type = 'image' === meta.filetype ? 'Images' : 'Files',
      url = '/filemanager?editor=tinymce5&type=' + type;
    tinymce.activeEditor.windowManager.openUrl({
      url: url,
      title: 'Filemanager',
      width: x * 0.8,
      height: y * 0.8,
      onMessage: (api, message) => {
        callback(message.content);
      }
    });
  }
});
