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

  $(document).on("keyup", "input[data-type='currency']", function() {
    formatCurrency($(this));
  })

});

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

function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.

  // get input value
  var input_val = input.val();

  // don't validate empty input
  if (input_val === "") {
    input.val(0);
    return;
  }

  // replace input start 0
  if (input_val[0] === '0') {
    input_val = input_val.substring(1);
  }

  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");

  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);

    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }

    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = input_val;

    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }

  // send updated string to input
  input.val(input_val);
  if (input_val === "") {
    input.val(0);
  }

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

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

