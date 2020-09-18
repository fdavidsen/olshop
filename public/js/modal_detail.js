let id = -1;

$('#products-list').on('click', '.see-detail', function() {
  id = $(this).data('id');
  $('.carousel-inner').html('');
  $.ajax({
  	url: baseURL + 'Home/getProductDetail/' + id,
  	dataType: 'JSON',
  	type: 'POST',
  	success: function(result) {
      result.productLibrary.forEach(function(item) {
        if (item.type == 'image') {
          $('.carousel-inner').append('<div class="carousel-item"><img src="' + baseURL + 'public/product/' + item.file_name + '" class="d-block w-100" alt="Product"></div>');
        } else if (item.type == 'video') {
          $('.carousel-inner').append('<div class="carousel-item"><video src="' + baseURL + 'public/product/' + item.file_name + '" class="d-block w-100" loop></video></div>');
        }
      });
      $('.carousel-inner').children(':first-child').addClass('active').children().attr('autoplay', 'autoplay');

  		$('#product-name').html(result.product.name);
  		$('#category').html(result.product.category);
  		$('#price').html(result.product.price + ' IDR');
  		$('#description').html(result.product.description);
      $('#like-counts').html(result.product.likes);
      $('.like').html(result.button);
  	}
  });
});

$('#product-detail').on('click', '.like', function() {
  $.ajax({
    url: baseURL + 'Home/likeProduct/' + id,
    dataType: 'JSON',
    type: 'POST',
    success: function(result) {
      $('#like-counts').html(result.likeCounts);
      $('.like').html(result.button);
    }
  });
});