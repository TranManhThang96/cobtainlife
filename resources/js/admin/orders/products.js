$(document).ready(function () {
  $('#add-product-order').click(function() {
    let uuid = Date.now();
    const trHiddenOrderDetail = $('#order-detail-hidden');
    let trHiddenOrderDetailHtml = trHiddenOrderDetail.html();
    const regex = /\$index/g;
    trHiddenOrderDetailHtml = trHiddenOrderDetailHtml.replace(regex, '');
    trHiddenOrderDetail.parent().append(`<tr id="order-detail-${uuid}" data-uuid="${uuid}">${trHiddenOrderDetailHtml}</tr>`);
    $(`#order-detail-${uuid} .select-product`).select2({
      placeholder: "Select a option",
    });

    $(`#order-detail-${uuid} .select-product`).on('select2:select', function (e) {
      var data = e.params.data;
      let productId = data.id;
      
      // load product
      $.ajax({
        url: `/products/${productId}`,
        type: 'GET',
        loading: true,
        success: function (response) {
          handleSelectProduct(uuid, response.data);
          
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
        }
      });
    })
  })

  $(document).on('click', '.btn-delete-order-detail', function() {
    $(this).parent().parent().remove();
  })

  $(document).on('change', '.order-detail-qty', function() {
    const uuid = $(this).parent().parent().data('uuid');
    handleUpdateTotal(uuid);
  })

  $(document).on('change', '.order-detail-price', function() {
    const uuid = $(this).parent().parent().data('uuid');
    handleUpdateTotal(uuid);
  })

  function handleSelectProduct(uuid, product) {
    $(`#order-detail-${uuid} input[name="product_sku[]"]`).val(product.sku);
    $(`#order-detail-${uuid} input[name="product_id[]"]`).val(product.id);
    $(`#order-detail-${uuid} input[name="product_name[]"]`).val(product.name);
    let finalPrice = 0;
    if (product.promotionValid) {
      $(`#order-detail-${uuid} input[name="price[]"]`).val(product.promotion.price_promotion);
      finalPrice = product.promotion.price_promotion;
    } else {
      $(`#order-detail-${uuid} input[name="price[]"]`).val(product.price);
      finalPrice = product.price
    }
    
    $(`#order-detail-${uuid} .product_total`).val(finalPrice);
  }

  function handleUpdateTotal(uuid) {
    try {
      let qty = parseInt($(`#order-detail-${uuid} input[name="qty[]"]`).val());
      let productPrice = parseInt($(`#order-detail-${uuid} input[name="price[]"]`).val());
      $(`#order-detail-${uuid} .product_total`).val(qty * productPrice);
    } catch(e) {
      console.log('handleUpdateTotal', e)
    }
    
  }
})