/**
 * Load page of searched products base on parameters.
 * > Home
 */
function searchProducts(target, keyword, order) {
	let args = target + '/';

	(keyword == '') ? 	(args += 'nullnanfalse/') : (args += keyword + '/');
	if (order != '')		args += order;
	
	$('#products-list').load(baseURL + 'Home/searchProducts/' + args);
}

/**
 * Type keyword to search for.
 * > Home
 */
$('#search').on('keyup', function() {
	const keyword = $(this).val();
	const order = $('#order-by').children('option:selected').val();
  searchProducts('home', keyword, order);
});

$('#order-by').change(function() {
	const keyword = $('#search').val();
	const order = $(this).children('option:selected').val();
	searchProducts('home', keyword, order);
});

/**
 * Type keyword to search for.
 * > Manage > Product
 */
$('#manage_search').on('keyup', function() {
	const keyword = $(this).val();
	const order = $('#manage_order-by').children('option:selected').val();
  searchProducts('manage', keyword, order);
});

$('#manage_order-by').change(function() {
	const keyword = $('#manage_search').val();
	const order = $(this).children('option:selected').val();
	searchProducts('manage', keyword, order);
});

/**
 * Load page of searched admins.
 * > Manage > Admin
 */
$('#search-admins').on('keyup', function() {
	const keyword = $(this).val();
  $('#admins-list').load(baseURL + 'Manage/searchAdmins/' + keyword);
});