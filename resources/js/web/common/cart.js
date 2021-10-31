import localStorageDB from './local_storage';
import utils from './utils';

$(document).ready(function () {
  var localStorageModel;
  var utilsHelper;
  var cart = {};
  var wishList = [];
  var compareList = [];
  var currentPage = '';

  init();

  // load cart, wishList, compareList
  function init() {
    localStorageModel = new localStorageDB();
    utilsHelper = new utils();
    loadWishList();
    loadCompareList();
    currentPage = window.location.pathname.toString();
    loadCart();
  }

  //handle event add product to wishList
  $(document).on('click', '.add-wishlist', function () {
    const productId = $(this).data('product-id');
    let currentWishList = localStorageModel.get('wishlist');
    if (!currentWishList) {
      currentWishList = [];
    } else {
      currentWishList = JSON.parse(currentWishList);
    }
    if (!currentWishList.includes(productId)) {
      currentWishList.push(productId);
      toastr.success('Thêm vào wishlist thành công');
    } else {
      toastr.error('Sản phẩm đã có trong wishlist!');
    }
    wishList = currentWishList;
    $('#count-wishlist').text(wishList.length);
    localStorageModel.set('wishlist', JSON.stringify(currentWishList));
  })

  //handle event add product to compareList
  $(document).on('click', '.add-compare-list', function () {
    const productId = $(this).data('product-id');
    let currentCompareList = localStorageModel.get('compareList');
    if (!currentCompareList) {
      currentCompareList = [];
    } else {
      currentCompareList = JSON.parse(currentCompareList);
    }
    if (!currentCompareList.includes(productId)) {
      currentCompareList.push(productId);
      toastr.success('Thêm vào compare thành công');
    } else {
      toastr.error('Sản phẩm đã có trong compare!');
    }

    compareList = currentCompareList;
    $('#count-compare-list').text(compareList.length);
    localStorageModel.set('compareList', JSON.stringify(currentCompareList));
  })

  //handle event add product to compareList
  $(document).on('click', '.add-compare-list', function () {
    const productId = $(this).data('product-id');
    let currentCompareList = localStorageModel.get('compareList');
    if (!currentCompareList) {
      currentCompareList = [];
    } else {
      currentCompareList = JSON.parse(currentCompareList);
    }
    if (!currentCompareList.includes(productId)) {
      currentCompareList.push(productId);
    }
    compareList = currentCompareList;
    $('#count-compare-list').text(compareList.length);
    localStorageModel.set('compareList', JSON.stringify(currentCompareList));
  })

  //handle event add product to cart
  $(document).on('click', '.add-to-cart', function () {
    const productFullId = $(this).data('product-full-id');
    let currentCart = localStorageModel.get('cart');
    if (!currentCart) {
      currentCart = {};
    } else {
      currentCart = JSON.parse(currentCart);
    }

    if (!currentCart.hasOwnProperty(`${productFullId}`)) {
      const product = {
        full_id: productFullId,
        id: $(this).data('product-id'),
        sku: $(this).data('product-sku'),
        name: $(this).data('product-name'),
        image: $(this).data('product-image'),
        link: $(this).data('product-link'),
        price: $(this).data('product-price'),
        qty: 1,
        attribute: {},
      };
      currentCart[`${productFullId}`] = product;
    } else {
      currentCart[`${productFullId}`]['qty'] += 1;
    }

    cart = currentCart;
    getQtyProductsCart();
    localStorageModel.set('cart', JSON.stringify(currentCart));
  })

  // handle update cart
  $(document).on('click', '.product-qty-desc', function () {
    const fullId = $(this).data('full-id');
    if (cart[fullId]['qty'] == 1) {
      removeOrderItem(fullId);
    } else {
      cart[fullId]['qty'] -= 1;
      localStorageModel.set('cart', JSON.stringify(cart));
      getQtyProductsCart();
      renderCart();
    }
  })

  // handle update cart
  $(document).on('click', '.product-qty-inc', function () {
    const fullId = $(this).data('full-id');
    cart[fullId]['qty'] += 1;
    localStorageModel.set('cart', JSON.stringify(cart));
    getQtyProductsCart();
    renderCart();
  })

  // handle remove item in cart
  $(document).on('click', '.remove-order-item', function () {
    const fullId = $(this).data('full-id');
    removeOrderItem(fullId);
  })

  // handle remove item in wishlist
  $(document).on('click', '.remove-wishlist-item', function () {
    const productId = $(this).data('product-id');
    const index = wishList.indexOf(productId);
    if (index > -1) {
      wishList.splice(index, 1);
      $('#count-wishlist').text(wishList.length);
      localStorageModel.set('wishlist', JSON.stringify(wishList));
      $(this).closest('.row_cart.wishlist').remove();
      toastr.success('Xóa sản phẩm wishlist thành công');
    }

    if (wishList.length == 0) {
      $('#product-render-data').empty().html(`<div class="row mt-5">
                          <span class="text-danger">Không tìm thấy dữ liệu</span>
                      </div>`);
    }
  })

  // handle remove item in compare list
  $(document).on('click', '.remove-compare-item', function () {
    const productId = $(this).data('product-id');
    const index = compareList.indexOf(productId);
    if (index > -1) {
      compareList.splice(index, 1);
      $('#count-compare-list').text(compareList.length);
      localStorageModel.set('compareList', JSON.stringify(compareList));
      $(this).closest('.compare-product').remove();
      toastr.success('Xóa sản phẩm compare thành công');
    }

    if (compareList.length == 0) {
      $('#product-render-data').empty().html(`<div class="row mt-5">
                          <span class="text-danger">Không tìm thấy dữ liệu</span>
                      </div>`);
    }
  })


  $(document).on('click', '#go-checkout-confirm', function () {
    if (Object.keys(cart).length == 0) {
      toastr.error('Giỏ hàng trống!');
      return;
    }
    window.location.href = '/checkout';
  })

  $(document).on('click', '#checkout-confirm-submit-order', function () {
    $.ajax({
      url: `/add-order`,
      type: 'POST',
      loading: true,
      success: function (response) {
        toastr.success(response.msg);
        resetCart();
        setTimeout(() => {
          window.location.href = '/';
        }, 3000);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error(jqXHR.responseJSON.userMsg);
      }
    });
  })

  // checkout process
  $(document).on('click', '#button-payment-process', function () {
    if (Object.keys(cart).length == 0) {
      toastr.error('Giỏ hàng trống!');
      return;
    }
    let dataForm = $('#frm-order-info').serializeArray();
    dataForm.push({ name: 'cart', value: JSON.stringify(cart) });
    $.ajax({
      url: `/checkout`,
      type: 'POST',
      loading: true,
      data: dataForm,
      success: function (response) {
        window.location.href = response.data
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          utilsHelper.setError(errors, '#frm-order-info');
        } else {
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })

  function loadCart() {
    let currentCart = localStorageModel.get('cart');
    if (!currentCart) {
      currentCart = {};
    } else {
      currentCart = JSON.parse(currentCart);
    }
    cart = currentCart;
    getQtyProductsCart();
    if (currentPage === '/cart' || currentPage === '/checkout') {
      renderCart();
    }
  }

  function getQtyProductsCart() {
    let qty = 0;
    try {
      for (let productFullId in cart) {
        qty += cart[`${productFullId}`]['qty'];
      }
    } catch (e) {
      qty = 0;
    }
    $('#qty-product-cart').text(qty);
    return qty;
  }

  function loadWishList() {
    let currentWishList = localStorageModel.get('wishlist');
    if (!currentWishList) {
      currentWishList = [];
    } else {
      currentWishList = JSON.parse(currentWishList);
    }
    wishList = currentWishList;
    $('#count-wishlist').text(wishList.length);
  }

  function loadCompareList() {
    let currentCompareList = localStorageModel.get('compareList');
    if (!currentCompareList) {
      currentCompareList = [];
    } else {
      currentCompareList = JSON.parse(currentCompareList);
    }
    compareList = currentCompareList;
    $('#count-compare-list').text(compareList.length);
  }

  function renderCart() {
    let renderHtml = '';
    let subTotal = 0;
    if (Object.keys(cart).length == 0) {
      $('#order-subtotal').text(0);
      $('#checkout-subtotal').text(0);
      $('#checkout-total').text(0);
      $('#cart-items').empty().append(`
      <tr>
        <td colspan="4" class="text-center mt-5">Giỏ hàng trống!</td>
      </tr>`);
      return;
    }

    for (let productFullId in cart) {
      renderHtml += `
      <tr class="align-items-center order-item">
        <td class="border-top-0 border-bottom px-0 py-6">
          <div class="d-flex align-items-center">
            <div class="imgHolder">
              <img src=${cart[productFullId]['image'] ? cart[productFullId]['image'] : '/dist/images/70x80.png'} width="70px" height="80px" alt="image description" class="img-fluid product-image" />
            </div>
            <span class="title pl-2">
              <a href="${cart[productFullId]['link']}" class="product-link" target="_blank">${cart[productFullId]['name']}</a>
            </span>
          </div>
          <div class="mt-2">
            <b>Mã SKU</b><span> : ${cart[productFullId]['sku']} </span><br>
            ${renderAttribute(cart[productFullId]['attribute'])}
          </div>
        </td>
        <td class="fwEbold border-top-0 border-bottom px-0 py-6">
          <span class="product-price">${utilsHelper.formatNumber(cart[productFullId]['price'])} VND</span>
        </td>
        <td class="border-top-0 border-bottom px-0 py-6"> 
          <span class="jcf-number">
            <input type="number" placeholder="1" class="product-qty jcf-real-element" value="${cart[productFullId]['qty']}">
            <span class="jcf-btn-inc product-qty-inc" data-full-id="${productFullId}"></span>
            <span class="jcf-btn-dec product-qty-desc" data-full-id="${productFullId}"></span>
          </span>
        </td>
        <td class="fwEbold border-top-0 border-bottom px-0 py-6">
          <span class="product-total-price">${utilsHelper.formatNumber(cart[productFullId]['price'] * cart[productFullId]['qty'])} VND</span>
          <a href="javascript:void(0);" class="fas fa-times float-right remove-order-item" data-full-id="${productFullId}"></a>
        </td>
      </tr>`
      subTotal += cart[productFullId]['qty'] * cart[productFullId]['price']
    }
    $('#order-subtotal').text(utilsHelper.formatNumber(subTotal));
    $('#checkout-subtotal').text(utilsHelper.formatNumber(subTotal));
    $('#checkout-total').text(utilsHelper.formatNumber(subTotal));
    $('#cart-items').empty().append(renderHtml);

  }

  function renderAttribute(attributes) {
    let renderAttr = '';
    if (Object.keys(attributes).length > 0) {
      for (let attrId in attributes) {
        renderAttr += `
          <b>${attributes[attrId]['shop_attribute_group']['name']}</b><span class="pr-2"> : ${attributes[attrId]['name']} </span>
        `
      }
    }
    return renderAttr;
  }

  function removeOrderItem(fullId) {
    delete cart[fullId];
    localStorageModel.set('cart', JSON.stringify(cart));
    getQtyProductsCart();
    renderCart();
  }

  function resetCart() {
    cart = {};
    localStorageModel.remove('cart')
    getQtyProductsCart();
  }
})

