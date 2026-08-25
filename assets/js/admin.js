/**
 * Media pickers for the theme's meta boxes.
 */
(function ($) {
	'use strict';

	$(document).on('click', '.rh-media-field__pick', function (event) {
		event.preventDefault();

		var $field = $(this).closest('.rh-media-field');
		var type = $field.data('media-type') === 'video' ? 'video' : 'image';

		var frame = wp.media({
			title: type === 'video' ? 'Choose a video' : 'Choose an image',
			library: { type: type },
			button: { text: 'Use this file' },
			multiple: false
		});

		frame.on('select', function () {
			var attachment = frame.state().get('selection').first().toJSON();

			$field.find('.rh-media-field__input').val(attachment.url).trigger('change');
		});

		frame.open();
	});

	$(document).on('click', '.rh-media-field__clear', function (event) {
		event.preventDefault();

		$(this).closest('.rh-media-field').find('.rh-media-field__input').val('').trigger('change');
	});
})(jQuery);
