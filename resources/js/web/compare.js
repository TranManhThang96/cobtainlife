import localStorageDB from './common/local_storage';

$(document).ready(function() {
  var localStorageModel;
  init();

  function init() {
    localStorageModel = new localStorageDB();
    renderCompareList();
  }

  function renderCompareList() {
    let compareList = localStorageModel.get('compareList');
    if (!compareList) {
      // toastr.error('Không tìm thấy dữ liệu!');
      return;
    }

    $.ajax({
      url: `/compare`,
      type: 'POST',
      loading: false,
      data: {compareList: compareList},
      success: function (response) {
        $('#product-render-data').empty().html(response.data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error(jqXHR.responseJSON.userMsg);
      }
    });
  }
})