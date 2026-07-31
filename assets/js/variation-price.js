jQuery(function ($) {
	const $form = $('.variations_form');
	const $mainPrice = $('.summary .price').first();

	if (!$form.length || !$mainPrice.length) {
		return;
	}

	const originalPrice = $mainPrice.attr('data-original-price');

	$form.on('found_variation', function (event, variation) {
		if (variation && variation.price_html) {
			$mainPrice.html(variation.price_html);
		}
	});

	$form.on('reset_data hide_variation', function () {
		if (originalPrice) {
			$mainPrice.html(originalPrice);
		}
	});
});