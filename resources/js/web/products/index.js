$(document).ready(function () {
  // page, sort_by, order_by, 
  let filters = {};
  let viewFilters = {};
  renderUIFilters();
  $(document).on('click', '.sort-option', function(e) {
    e.preventDefault();
    const sort = $(this).data('sort');
    const sortBy = sort.split('-')[0];
    const orderBy = sort.split('-')[1];
    $('#sortGroup').text($(this).text());
    filters['sort_by'] = sortBy;
    filters['order_by'] = orderBy;
    getLists();
  })

  $('.sort-category').click(function() {
    const categoryId = $(this).data('id');
    filters['category_id'] = categoryId;
    viewFilters['category'] = {
      'type': 'category',
      'label': 'Danh mục',
      'value': $(this).data('title')
    }
    getLists();
  })

  $('#btn-search-product').click(function() {
    const query = $('#frm-search-query').val();
    filters['q'] = query;
    viewFilters['q'] = {
      'type': 'q',
      'label': 'Tìm kiếm',
      'value': query
    }
    getLists();
  })

  $(document).on('click', '.filter-group-price .filter-item:not(.active)', function (e) {
    $('.filter-group-price .filter-item').removeClass('active');
    $(this).addClass('active');
    const min = $(this).data('min');
    const max = $(this).data('max');
    filters['min'] = min;
    filters['max'] = max;
    viewFilters['price'] = {
      'type': 'price',
      'label': 'Giá',
      'value': $(this).find('.filter-item-label').text()
    }
    getLists();
  })

  $(document).on('click', '.filter-group-humidity .filter-item:not(.active)', function (e) {
    $('.filter-group-humidity .filter-item').removeClass('active');
    $(this).addClass('active');
    filters['humidity'] = $(this).data('value');
    viewFilters['humidity'] = {
      'type': 'humidity',
      'label': 'Độ ẩm',
      'value': $(this).find('.filter-item-label').text()
    }
    getLists();
  })

  $(document).on('click', '.filter-group-light .filter-item:not(.active)', function (e) {
    $('.filter-group-light .filter-item').removeClass('active');
    $(this).addClass('active');
    filters['light'] = $(this).data('value');
    viewFilters['light'] = {
      'type': 'light',
      'label': 'Ánh sáng',
      'value': $(this).find('.filter-item-label').text()
    }
    getLists();
  })

  $(document).on('click', '.filter-group-water .filter-item:not(.active)', function (e) {
    $('.filter-group-water .filter-item').removeClass('active');
    $(this).addClass('active');
    filters['water'] = $(this).data('value');
    viewFilters['water'] = {
      'type': 'water',
      'label': 'Lượng nước',
      'value': $(this).find('.filter-item-label').text()
    }
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

  $(document).on('click', '#clear-filter-button', function(e) {
    filters = {};
    viewFilters = {};
    $('.filter-group .filter-item').removeClass('active');
    $('#frm-search-query').val('');
    getLists();
  })

  $(document).on('click', '.view-filters .filter-item', function() {
    const type = $(this).data('type');
    if (type === 'q') {
      $('#frm-search-query').val('');
      delete viewFilters[type];
      delete filters[type];
    } else if (type === 'category') {
      delete viewFilters['category'];
      delete filters['category_id'];
    } else if (type === 'price') {
      delete viewFilters['price'];
      delete filters['min'];
      delete filters['max'];
      $(`.filter-group-${type} .filter-item`).removeClass('active');
    } else {
      delete viewFilters[type];
      delete filters[type];
      $(`.filter-group-${type} .filter-item`).removeClass('active');
    }
    getLists();
  })

  changePage = (page, url = null, isNext = false, isPrev = false) => {
    // clean uri if has query string
    let uri = window.location.href.toString();
    if (uri.indexOf("?") > 0) {
      let clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
    }
  
    if (page && !isNaN(page)) {
      filters['page'] = page;
    } else {
      let pageCurrent = 1;
      pageCurrent = parseInt($('.page-link-item.active .page-link').text());
  
      if (isNext) {
        let pageMax = $('.page-link-item:last').prev().children().text();
        if (pageMax > pageCurrent) {
          filters['page'] = pageCurrent + 1;
        }
      } else if (isPrev) {
        if (pageCurrent > 1) {
          filters['page'] = pageCurrent - 1;
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
    renderUIFilters();
    $.ajax({
      type: 'GET',
      url: url,
      loading: true,
      data: filters,
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

  function renderUIFilters() {
    if (Object.keys(viewFilters).length === 0) {
      $('.view-filters').addClass('d-none');
      return;
    }
    let viewHtml = '';
    for (const [key, value] of Object.entries(viewFilters)) {
      viewHtml +=
      `<div class="filter-item active" data-type="${key}">
        <span class="filter-item-label">${value.label}: ${value.value}</span>
        <div class="filter-item-checked"></div>
        <span class="icon-checked">X</span>
      </div>`
    }
    $('.view-filters .filter-group').empty().append(viewHtml);
    $('.view-filters').removeClass('d-none');
  }
})