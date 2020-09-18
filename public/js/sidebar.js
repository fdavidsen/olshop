function show() {
  $('.sidebar-wrapper').css('margin-left', '0');
  $('.content-wrapper').css('width', 'calc(100% - 15rem)');
}

function hide() {
  $('.sidebar-wrapper').css('margin-left', '-15rem');
  $('.content-wrapper').css('width', '100%');
}

$(window).on('load resize', function() {
  const width = $(document).width();
  (width < 768) ? hide() : show();
});

$('#menu-toggle').click(function() {
  const ml = $('.sidebar-wrapper').css('margin-left');
  (ml == '0px') ? hide() : show();
});

$('.sidebar-wrapper .title').on('click', function() {
  $(this).siblings().toggleClass('d-none');
});

$('.sidebar-wrapper a').filter(function() {
  return this.href == location.href;
}).parent().children().removeClass('d-none');