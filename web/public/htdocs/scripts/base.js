$(document).ready(function () {
  window.onscroll = function () {
    if (window.pageYOffset > 25) {
      $("header").addClass('shadow');
    } else {
      $("header").removeClass('shadow');
    }
  }
  window.onscroll();

  $(".header-profile-pic").on('click', function () {
    if ($('.user-dropdown-wrapper').css('display') === 'block') {
      $('.user-dropdown-wrapper').css('display', 'none');
    } else {
      $('.user-dropdown-wrapper').css('display', 'block');
    }
  });
  $(".user-profile").attr('href', "/user/" + username);
  const buttons = document.querySelectorAll('.mdc-button');
  for (const button of buttons) {
    mdc.ripple.MDCRipple.attachTo(button);
  }
});