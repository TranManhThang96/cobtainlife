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
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  $('.btn-social').click(function () {
    window.open($(this).data('href'), '_blank')
  })

  $('.comment-rating a.star').mouseenter(function () {
    let eID = $(this).data('id');
    eID = eID.split('-').splice(-1);
    for (var i = 1; i <= eID; i++) {
      $(`a[data-id="star-${i}"] i`).addClass('fas').removeClass('far');
    }
  }).mouseleave(function () {
    $('.comment-rating a.star i').removeClass('fas').addClass('far');
    let rating = $('.comment-rating input[name="rating"]').val();
    rating = parseInt(rating);
    if (rating > 0) {
      for (var i = 1; i <= rating; i++) {
        $(`a[data-id="star-${i}"] i`).addClass('fas').removeClass('far');
      }
    }
  });

  /*
   * Sự kiện khi cho điểm
   */
  $('a.star').click(function () {
    let eID = $(this).data('id');
    eID = eID.split('-').splice(-1).toString();
    $('.comment-rating a.star i').removeClass('fas').addClass('far');
    for (var i = 1; i <= eID; i++) {
      $(`a[data-id="star-${i}"] i`).addClass('fas').removeClass('far');
    }
    $('.comment-rating input[name="rating"]').val(eID);
  });

  $('.navbar-search-icon').click(function() {
    const isClose = $(this).hasClass('close-search');
    const parentElement = $(this).parent();
    if (isClose) {
      parentElement.removeClass('active');
      $(this).find('.fa-times-circle').remove();
      $(this).removeClass('navbar-search-icon').removeClass('close-search').addClass('icon-search');
    } else {
      parentElement.addClass('active');
      setTimeout(() => {
        parentElement.find('input.rd-navbar-search-form-input').focus();
      }, 500)
      $(this).removeClass('icon-search').addClass('navbar-search-icon').addClass('close-search').append('<i class="fa fa-times-circle" aria-hidden="true" style="font-weight: 500;"></i>')
    }
  })

  $('#btn-subscribe-news').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: `/custom-subscribes`,
      type: 'POST',
      loading: true,
      data: $('#frm-subscribe-news').serialize(),
      success: function (response) {
        toastr.success(response.msg);
        setTimeout(() => {
          window.location.reload();
        }, 2000)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#frm-subscribe-news');
          toastr.error(errors.email[0]);
        } else {
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })

  $('#btn-contact-me').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: `/custom-subscribes`,
      type: 'POST',
      loading: true,
      data: $('#frm-contact-me').serialize(),
      success: function (response) {
        toastr.success(response.msg);
        setTimeout(() => {
          window.location.reload();
        }, 2000)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#frm-contact-me');
          toastr.error(errors.email[0]);
        } else {
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

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
