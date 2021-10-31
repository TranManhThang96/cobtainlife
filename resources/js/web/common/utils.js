var utils = function () {}

utils.prototype.formatNumber = function(n) {
  // format number 1234567 to 1,234,567
  try {
    n = n + '';
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  } catch (e) {
    return n;
  }
}

utils.prototype.convertStringToNumber = function(n) {
  // format number 1,234,567 to 1234567
  try {
    n = n + '';
    n = n.replace(/\,/g,''); // 1125, but a string, so convert it to number
    return parseInt(n,10);
  } catch (e) {
    return 0;
  }
}

utils.prototype.resetError = function() {
  $('.is-invalid').removeClass('is-invalid');
  $('.invalid-feedback').remove();
};

utils.prototype.setError = function(errors, parentElement = '') {
  utils.prototype.resetError();
  for (let error in errors) {
    let form_control;
    form_control = parentElement ? $(`${parentElement} .form-control[name="${error}"], ${parentElement} .custom-select[name="${error}"]`) : $(`.form-control[name="${error}"], .custom-select[name="${error}"]`);

    if (typeof form_control !== 'undefined') {
      form_control.addClass('is-invalid');
      form_control.parent().append(`<div class="invalid-feedback text-nowrap">${errors[error][0]}</div>`);
    }
  }
};

export default utils;
