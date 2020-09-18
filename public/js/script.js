/**
 * Move active class on navbar.
 */
$('.navbar a').filter(function() {
	return this.href == location.href;
}).parent().addClass('active').siblings().removeClass('active');

$('.navbar-nav a').click(function() {
	$(this).parent().addClass('active').siblings().removeClass('active');
});

/**
 * Replace img if it is error or unavailable.
 */
$('img').on('error', function() {
  $(this).attr('src', baseURL + 'public/img/no_image_available.jpg');
});

/**
 * Change label of file input to its real file name.
 */
$('.custom-file input').change(function(e) {
  let files = [];
  for (let i = 0; i < $(this)[0].files.length; i++) {
    files.push($(this)[0].files[i].name);
  }
  $(this).next('.custom-file-label').html(files.join(', '));
});

/**
 * Change height of textareas base on their content.
 */
$('textarea').each(function() {
  $(this).height($(this).prop('scrollHeight'));
});

$('textarea').on('input', function() {
  $(this).height(0).height(this.scrollHeight);
});

/**
 * Pause every video if it's out of screen.
 */
$(window).scroll(function() {
	$('video').each(function() {
		if (! $(this).isOnScreen()) {
			$(this)[0].pause();
		}
	});
});

$('.content-wrapper').scroll(function() {
  $('video').each(function() {
    if (! $(this).isOnScreen()) {
      $(this)[0].pause();
    }
  });
});

$('.see-detail').on('click', function() {
  $('video').each(function() {
    $(this)[0].pause();
  });
});

$('#product-detail').on('hide.bs.modal', function() {
  $('video').each(function() {
    $(this)[0].pause();
  });
});

$('#product-detail').carousel().on('slid.bs.carousel', function() {
  $('.carousel-item').each(function() {
    if ($(this).children().is('video')) {
      $(this).hasClass('active') ? $(this).children()[0].play() : $(this).children()[0].pause();
    }
  });
});

/**
 * Hide spinner when everything is loaded.
 */
$(window).on('load', function() {
  $('.spinner-overlay').attr('hidden', '');
});