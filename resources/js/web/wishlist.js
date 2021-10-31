import localStorageDB from './common/local_storage';

$(document).ready(function() {
  var localStorageModel;
  init();

  function init() {
    localStorageModel = new localStorageDB();
    renderWishlist();
  }

  function renderWishlist() {
    let wishList = localStorageModel.get('wishlist');
    if (!wishList) {
      // toastr.error('Không tìm thấy dữ liệu!');
      return;
    }

    $.ajax({
      url: `/wishlist`,
      type: 'POST',
      loading: false,
      data: {wishList: wishList},
      success: function (response) {
        $('#product-render-data').empty().html(response.data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error(jqXHR.responseJSON.userMsg);
      }
    });
  }
})