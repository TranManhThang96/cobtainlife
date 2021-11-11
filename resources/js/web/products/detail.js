import localStorageDB from '../common/local_storage';
import utils from './../common/utils';

$(document).ready(function () {
  var utilsClass;
  var localStorageModel;
  init();

  function init() {
    utilsClass = new utils();
    localStorageModel = new localStorageDB();
    updatePrice();
  }

  function updatePrice() {
    let addPrice = 0;
    let attributes = {};
    let productAttributeFullId = '';
    $(`.attribute-group-options`).each(function (index, item) {
      let attributeChecked = $(item).find(`input:radio.attribute-option-item:checked`);
      let attributeCheckedPrice = attributeChecked.data('add-price');
      let attributeCheckedVal = attributeChecked.val();
      let attributeCheckedJson = attributeChecked.data('attribute-json');
      if (typeof attributeCheckedPrice !== 'undefined') {
        addPrice += parseInt(attributeCheckedPrice);
        attributes[attributeCheckedVal] = attributeCheckedJson;
        if (productAttributeFullId === '') {
          productAttributeFullId = attributeCheckedVal;
        } else {
          productAttributeFullId = productAttributeFullId + '-' + attributeCheckedVal;
        }
      }
    })
    $(`#product-name`).attr('data-product-full-id', productAttributeFullId);
    $(`#product-name`).attr('data-product-attribute', JSON.stringify(attributes));
    $(`#product-price`).attr('data-product-add-price', addPrice);
    const productPrice = $(`#product-price`).data('product-price');
    $(`#product-price`).text(utilsClass.formatNumber(productPrice + addPrice) + ' VND');

  }

  $(document).on('change', '.attribute-option-item', function () {
    updatePrice()
  })

  // handle event add product to cart
  $(document).on('click', '#detail-btn-add-cart', function (e) {
    e.preventDefault();
    const productFullId = $('#product-name').data('product-full-id');
    let currentCart = localStorageModel.get('cart');
    if (!currentCart) {
      currentCart = {};
    } else {
      currentCart = JSON.parse(currentCart);
    }

    const qty = parseInt($('#product-qty').val());
    if (!currentCart.hasOwnProperty(`${productFullId}`)) {
      const productPrice = $(`#product-price`).data('product-price');
      const addPrice = $(`#product-price`).data('product-add-price');
      const product = {
        full_id: productFullId,
        id: $('#product-name').data('product-id'),
        sku: $('#product-name').data('product-sku'),
        image: $('#product-name').data('product-image'),
        link: $('#product-name').data('product-link'),
        name: $('#product-name').text(),
        price: parseInt(productPrice) + parseInt(addPrice),
        qty: qty,
        attribute: $('#product-name').data('product-attribute'),
      };
      currentCart[`${productFullId}`] = product;
    } else {
      currentCart[`${productFullId}`]['qty'] += qty;
    }

    localStorageModel.set('cart', JSON.stringify(currentCart));
    // go to card
    window.location.href = '/cart';
  })

  $('.name').nameBadge();
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
