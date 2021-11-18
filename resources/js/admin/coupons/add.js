$(document).ready(function () {
  // set datepicker
  $('body').on('focus', ".datepicker", function () {
    $(this).datepicker();
  });
})