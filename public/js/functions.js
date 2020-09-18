$.fn.isOnScreen = function() {
  const win = $(window);

  let viewport = {
    top : win.scrollTop(),
    left : win.scrollLeft()
  };
  viewport.right = viewport.left + win.width();
  viewport.bottom = viewport.top + win.height();

  let bounds = this.offset();
  bounds.right = bounds.left + this.outerWidth();
  bounds.bottom = bounds.top + this.outerHeight();

  return ! (viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom);
};



/**
 * Show/Hide password.
 */
function toggleVisibility() {
  if ($('.password').attr('type') == 'password') {
    $('.password').attr('type', 'text');
  } else {
    $('.password').attr('type', 'password');
  }
}