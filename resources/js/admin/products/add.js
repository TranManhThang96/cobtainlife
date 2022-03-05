$(document).ready(function () {
  $('.custom-select-2').select2({
    placeholder: "Select a option",
  });

  $('.select-tags').select2({
    placeholder: "",
    tags: true,
    tokenSeparators: [',']
  });

  // add sub image
  $('#add-sub-image').click(function () {
    let route_prefix = '/filemanager';

    window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      let filePaths = items.map(function (item) {
        return item.url;
      });

      for(let key in filePaths) {
        const filePath = filePaths[key];
        let uuid = Date.now() + '' + key;
        let filePathShort = filePath.split('storage');
        let newRowImage = `
            <div class="row sub-image mx-0 mt-3 image-product">
              <div class="input-group">
                <div class="custom-file">
                  <input type="text" value="${filePathShort[1]}" name="sub_images[]" class="form-control" id="sub-image-${uuid}" />
                </div>
                <div class="input-group-append">
                  <span title="Remove" class="btn btn-flat btn-danger remove-sub-image"><i class="fa fa-times"></i></span>
                </div>
              </div>
              <div id="preview-sub-image-${uuid}" class="img-holder mt-3">
                <img src="${filePath}">
              </div>
            </div>
        `
        $('.group-image').append(newRowImage);
      }
    }
  })

  // remove sub image
  $(document).on('click', '.remove-sub-image', function () {
    var imageProductRow = $(this).closest('.image-product');
    imageProductRow.remove();
  })

  // choose image
  $(document).on('click', '.lfm', function () {
    let route_prefix = '/filemanager';
    let inputId = $(this).data('input');
    let previewId = $(this).data('preview');
    let imageProductRow = $(this).closest('.image-product');

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
      let previewHtml = `
        <div id="${previewId}" class="img-holder mt-3">
          <img src="${file_path}">
        </div>
      `;

      imageProductRow.append(previewHtml);
    };
  })

  // set datepicker
  $('body').on('focus', ".datepicker", function () {
    $(this).datepicker();
  });

  $(document).on('click', '#add-product-promotion', function () {
    let pricePromotionElement = `
    <div class="price_promotion">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
        </div>
        <input id="price-promotion" name="price_promotion" value="0" class="form-control input-sm price" placeholder="" data-type='currency'/>
        <span title="Remove" class="btn btn-flat btn-danger remove-promotion" id="remove-product-promotion">
          <i class="fa fa-times"></i>
        </span>
      </div>
      <div class="form-group">
        <label class="mt-3">Ngày bắt đầu</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
          </div>
          <input
            type="text"
            style="width: 150px;"
            id="price-promotion-start"
            name="price_promotion_start"
            value=""
            class="form-control input-sm price-promotion-start date-time datepicker"
            data-date-format="dd/mm/yyyy"
            placeholder="dd/mm/yyyy"
          />
        </div>

        <label class="mt-3">Ngày kết thúc</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
          </div>
          <input type="text" style="width: 150px;" id="price-promotion-end" name="price_promotion_end" value="" class="form-control input-sm price-promotion-end date-time datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" />
        </div>
      </div>
    </div>`;
    $(this).parent().append(pricePromotionElement);
    $(this).remove();
  });

  $(document).on('click', '#remove-product-promotion', function () {
    let btnAddPromotion = `
      <button type="button" id="add-product-promotion" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Thêm giá khuyến mãi</button>
    `;
    $(this).closest('.price_promotion').parent().append(btnAddPromotion);
    $(this).closest('.price_promotion').remove();
  });

  $(document).on('click', '.add-attribute', function() {
    let attributeGroupId = $(this).data('attribute-group-id');
    let rowAttribute = `
    <div class="row attribute-item mt-3">
      <div class="col-6 pl-0">
        <input type="text" name="attributes[${attributeGroupId}][name][]" value="" class="form-control rounded-0 input-sm" placeholder="Nhập một thuộc tính" />
      </div>
      <div class="col-6">
        <div class="input-group">
          <input type="text" name="attributes[${attributeGroupId}][add_price][]" value="0" class="form-control rounded-0 input-sm" placeholder="Thêm tiền" data-type="currency"/>
          <span title="Remove" class="btn btn-flat btn-danger remove-attribute">
            <i class="fa fa-times"></i>
          </span>
        </div>
      </div>
    </div>
    `;
    $(`.list-attribute-${attributeGroupId}`).append(rowAttribute);
  })

  $(document).on('click', '.remove-attribute', function() {
    $(this).closest('.attribute-item').remove();
  })
})
