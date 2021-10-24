$(document).ready(function () {
  $(document).on('click', '.sort-option', function(e) {
    e.preventDefault();
    const sort = $(this).data('sort');
    const sortBy = sort.split('-')[0];
    const orderBy = sort.split('-')[1];
    $('#sortGroup').text($(this).text());
    $('#frm-search-price-from').val('');
    $('#frm-search-price-to').val('');
    $('#frm-search-sort-by').val(sortBy);
    $('#frm-search-order-by').val(orderBy);
    getLists();
  })

  $('.sort-category').click(function() {
    const categoryId = $(this).data('id');
    $('#frm-search-category-id').val(categoryId);
    getLists();
  })

  $('#btn-search-product').click(function() {;
    getLists();
  })

  $('#btn-filter-price').click(function() {
    $('#frm-search-sort-by').val('');
    $('#frm-search-order-by').val('');
    $('#frm-search-page').val(1);
    $('#frm-search-category-id').val('');
    $('#frm-search-category-id').val('');
    $('#frm-search-query').val('');
    $('#frm-search-price-from').val(convertStringToNumber($('#amount1').val()));
    $('#frm-search-price-to').val(convertStringToNumber($('#amount2').val()));
    getLists();
  })

  $(document).on('click', '.page-link-item .page-link', function (e) {
    e.preventDefault();
    let page = $(this).text();
    const type = $(this).data('type');
    let isNext = false, isPrev = false;
    if (type) {
      isNext = type == 'next';
      isPrev = type == 'prev';
    }
    if (isNext || isPrev) {
      page = '';
    }
    changePage(page, '/products/search', isNext, isPrev);
  });

  changePage = (page, url = null, isNext = false, isPrev = false) => {
    // clean uri if has query string
    let uri = window.location.href.toString();
    if (uri.indexOf("?") > 0) {
      let clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
    }
  
    if (page && !isNaN(page)) {
      $('#frm-search input[name="page"]').val(page);
    } else {
      let pageCurrent = 1;
      pageCurrent = parseInt($('.page-link-item.active .page-link').text());
  
      if (isNext) {
        let pageMax = $('.page-link-item:last').prev().children().text();
        if (pageMax > pageCurrent) {
          $('#frm-search input[name="page"]').val(pageCurrent + 1);
        }
      } else if (isPrev) {
        if (pageCurrent > 1) {
          $('#frm-search input[name="page"]').val(pageCurrent - 1);
        }
      }
    }
    getLists(url);
  };

  getLists = (url = 'products/search', successFunc = null, errorFunc = null) => {
    // clean uri if has query string
    let uri = window.location.href.toString();
    if (uri.indexOf("?") > 0) {
      let clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
    }
  
    $.ajax({
      type: 'GET',
      url: url,
      loading: true,
      data: $('#frm-search').serialize(),
    }).then(function (xhr) {
      $('#product-render-data').html(xhr.data);
      if (typeof successFunc === 'function') {
        successFunc(xhr);
      }
    }).catch(function (xhr) {
      // $('#data-table').html(xhr.responseJSON);
      if (typeof errorFunc === 'function') {
        errorFunc(xhr);
      }
    });
  };

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
})