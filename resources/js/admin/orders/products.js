var taxPercent = 10;

$(document).ready(function () {
  $('#add-product-order').click(function() {
    let uuid = Date.now();
    const trHiddenOrderDetail = $('#order-detail-hidden');
    let trHiddenOrderDetailHtml = trHiddenOrderDetail.html();
    const regex = /\#index/g;
    trHiddenOrderDetailHtml = trHiddenOrderDetailHtml.replace(regex, '');
    trHiddenOrderDetail.parent().append(`<tr id="order-detail-${uuid}" class="order-detail-product" data-uuid="${uuid}">${trHiddenOrderDetailHtml}</tr>`);
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
    updateSubTotal();
  })

  $(document).on('change', '.order-detail-qty', function() {
    const uuid = $(this).parent().parent().data('uuid');
    handleUpdateTotalProduct(uuid);
  })

  $(document).on('keyup', '.order-detail-qty', function() {
    const uuid = $(this).parent().parent().data('uuid');
    handleUpdateTotalProduct(uuid);
  })

  $(document).on('keyup', '.order-detail-price', function() {
    const uuid = $(this).parent().parent().data('uuid');
    handleUpdateTotalProduct(uuid);
  })

  $(document).on('change', '.attribute-option-item', function() {
    const uuid = $(this).closest('.order-detail-product').data('uuid');
    updateAddPrice(uuid);
    handleUpdateTotalProduct(uuid);
  })

  $(document).on('keyup', '#order-tax', function() {
    updateTotal();
    updateBalanceTotal();
  })

  $(document).on('keyup', '#order-shipping', function() {
    updateTotal();
    updateBalanceTotal();
  })

  $(document).on('keyup', '#order-discount', function() {
    updateTotal();
    updateBalanceTotal();
  })

  $(document).on('keyup', '#order-received', function() {
    updateBalanceTotal();
  })

  $(document).on('change', '#order-tax-option', function() {
    taxPercent = parseInt($(this).find(':selected').data('value'));
    updateTax();
  })
})

function updateAddPrice(uuid) {
  let addPrice = 0;
  let attributes = {};
  $(`#order-detail-${uuid} .attribute-group-options`).each(function(index, item) {
    let attributeChecked = $(item).find(`input:radio.attribute-option-item:checked`);
    let attributeCheckedPrice = attributeChecked.data('add-price');
    let attributeCheckedVal = attributeChecked.val();
    let attributeCheckedJson = attributeChecked.data('attribute-json');
    if (typeof attributeCheckedPrice !== 'undefined') {
      addPrice += parseInt(attributeCheckedPrice);
      attributes[attributeCheckedVal] = attributeCheckedJson;
    }
  })
  $(`#order-detail-${uuid} input[name="product_attribute[]"]`).val(JSON.stringify(attributes));
  $(`#order-detail-${uuid} input[name="product_attribute_add_pice[]"]`).val(formatNumber(addPrice));
}

function handleSelectProduct(uuid, product) {
  $(`#order-detail-${uuid} input[name="product_sku[]"]`).val(product.sku);
  $(`#order-detail-${uuid} input[name="product_id[]"]`).val(product.id);
  $(`#order-detail-${uuid} input[name="product_name[]"]`).val(product.name);
  $(`#order-detail-${uuid} input[name="product_qty[]"]`).val(1);
  let finalPrice = 0;
  if (product.promotionValid) {
    $(`#order-detail-${uuid} input[name="product_price[]"]`).val(formatNumber(product.promotion.price_promotion));
    finalPrice = product.promotion.price_promotion;
  } else {
    $(`#order-detail-${uuid} input[name="product_price[]"]`).val(formatNumber(product.price));
    finalPrice = product.price
  }
  $(`#order-detail-${uuid} .product_total`).val(formatNumber(finalPrice));
  let attributes_groups_view = product.attributes_groups_view;
  const regex = /\#index/g;
  attributes_groups_view = attributes_groups_view.replace(regex, uuid);
  $(`#order-detail-${uuid} .product-attributes`).empty().append(attributes_groups_view);
  updateAddPrice(uuid);
  handleUpdateTotalProduct(uuid);
  updateSubTotal();
}

function handleUpdateTotalProduct(uuid) {
  try {
    let qty = parseInt($(`#order-detail-${uuid} input[name="product_qty[]"]`).val());
    let productPrice = convertStringToNumber($(`#order-detail-${uuid} input[name="product_price[]"]`).val());
    let addPrice = convertStringToNumber($(`#order-detail-${uuid} input[name="product_attribute_add_pice[]"]`).val());
    $(`#order-detail-${uuid} .product_total`).val(formatNumber(qty * (productPrice + addPrice)));
    updateSubTotal();
  } catch(e) {
    console.log('handleUpdateTotalProduct', e)
  }
  
}

function updateSubTotal() {
  let subTotal = 0;
  $(`.order-detail-product .product_total`).each(function(index, item) {
    let subTotalItem = convertStringToNumber($(this).val());
    subTotal += subTotalItem;
  })
  $(`#order-subtotal`).val(formatNumber(subTotal));
  updateTax();
}

function updateTax() {
  const subTotal = convertStringToNumber($(`#order-subtotal`).val());
  const tax = parseInt(taxPercent * subTotal / 100);
  $(`#order-tax`).val(formatNumber(tax));
  updateTotal();
  updateBalanceTotal();
}


function updateTotal() {
  let total = 0;
  const subTotal = convertStringToNumber($(`#order-subtotal`).val());
  const tax = convertStringToNumber($(`#order-tax`).val());
  const shipping = convertStringToNumber($(`#order-shipping`).val());
  const discount = convertStringToNumber($(`#order-discount`).val());
  total = subTotal + tax + shipping - discount;
  $(`#order-total`).val(formatNumber(total));
}

function updateBalanceTotal() {
  let balance = 0;
  const total = convertStringToNumber($(`#order-total`).val());
  const received = convertStringToNumber($(`#order-received`).val());
  balance = total - received;
  $(`#order-balance`).val(formatNumber(balance));
}

function formatNumber(n) {
  // format number 1234567 to 1,234,567
  try {
    n = n + '';
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  } catch (e) {
    return n;
  }
}

function convertStringToNumber(n) {
  // format number 1,234,567 to 1234567
  try {
    n = n + '';
    n = n.replace(/\,/g,''); // 1125, but a string, so convert it to number
    return parseInt(n,10);
  } catch (e) {
    return 0;
  }
}