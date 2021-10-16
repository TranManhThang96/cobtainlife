let pageLoadingElement = $('.page-loading');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': window.$('meta[name="csrf-token"]').attr('content')
	},
	beforeSend: function () {
		if (this.loading) {
			pageLoadingElement.fadeIn();
		}
	},
	complete: function (res) {
		if (this.loading) {
			pageLoadingElement.fadeOut();
		}
		if (res['responseText'] == 'Session timeout occurred. Please login again') {
			window.location.href = '/';
		}
	}
});

$(document).ready(function () {
  window.toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
});

modalConfirm = function (title = 'Thông báo', body = 'Bạn có chắc chắn điều này?', titleCustom = null, bodyCustom = null) {
  let modalConfirm = $('#modal-confirm');
  modalConfirm.modal('show');
  let btnConfirm = $('#modal-confirm-btn-ok');
  let btnCancel = $('#modal-confirm-btn-cancel');

  //set title
  if (titleCustom) {
    let modalHeader = $('#modal-confirm .modal-header');
    modalHeader.empty();
    modalHeader.append(titleCustom);
    modalHeader.append(
      `<button type="button" class="close 1" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>`
    );
  } else {
    $('#modal-confirm .modal-header .modal-title').text(title);
  }

  //set body
  if (bodyCustom) {
    let modalBody = $('#modal-confirm .modal-body');
    modalBody.empty();
    modalBody.append(bodyCustom);
  } else {
    $('#modal-confirm .modal-body p').text(body);
  }

  return new Promise(function (resolve, reject) {
    btnConfirm.off().on('click', function () {
      modalConfirm.modal('hide');
      resolve(true);
    });

    btnCancel.off().on('click', function () {
      modalConfirm.modal('hide');
      resolve(false);
    });
  })
};

variableDefined = () => {
  return {
    SORTING_ASC_CLASS: 'sorting--asc',
    SORTING_DESC_CLASS: 'sorting--desc',
    ORDER_BY_ASC: 'asc',
    ORDER_BY_DESC: 'desc',
  }
}

/**
 * reset errors.
 */
resetError = () => {
  $('.is-invalid').removeClass('is-invalid');
  $('.invalid-feedback').remove();
};

/**
 * set errors.
 * @param errors
 * @param parentElement
 */
setError = (errors, parentElement = '') => {
  resetError();
  for (let error in errors) {
    let form_control;
    form_control = parentElement ? $(`${parentElement} .form-control[name="${error}"], ${parentElement} .custom-select[name="${error}"]`) : $(`.form-control[name="${error}"], .custom-select[name="${error}"]`);

    if (typeof form_control !== 'undefined') {
      form_control.addClass('is-invalid');
      form_control.parent().append(`<div class="invalid-feedback text-nowrap">${errors[error][0]}</div>`);
    }
  }
};

/**
 * handle when change page.
 * @param page
 */
changePage = (page, url = null, parentElement = null) => {
  // clean uri if has query string
  let uri = window.location.href.toString();
  if (uri.indexOf("?") > 0) {
    let clean_uri = uri.substring(0, uri.indexOf("?"));
    window.history.replaceState({}, document.title, clean_uri);
  }

  if (!isNaN(page)) {
    $('#frm-search input[name="page"]').val(page);
  } else {
    let pageCurrent = 1;
    if (parentElement) {
      pageCurrent = parseInt($(`${parentElement} .page-item.active .page-link`).text());
    } else {
      pageCurrent = parseInt($('.page-item.active .page-link').text());
    }

    if (page === '›') {
      let pageMax = $('.page-item:last').prev().children().text();
      if (pageMax > pageCurrent) {
        $('#frm-search input[name="page"]').val(pageCurrent + 1);
      }
    } else {
      if (pageCurrent > 1) {
        $('#frm-search input[name="page"]').val(pageCurrent - 1);
      }
    }
  }
  getLists(url);
};

/**
 * get lists.
 * @param successFunc
 * @param errorFunc
 */
getLists = (url = 'search', successFunc = null, errorFunc = null) => {
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
    $('#data-table').html(xhr.data);
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

