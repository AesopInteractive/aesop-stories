(function ( $ ) {
	"use strict";

	$(function () {

		$('#aesop_stories_contributors .repeat-field').text('Add New Contributor');
		$('#aesop_stories_contributors .cmb-delete-field').html('<span class="cmb-delete-field-icon">×</span> Remove Contributor');

		// menu hacks
		$('.post-php .toplevel_page_aesop-stories').addClass('wp-has-current-submenu').find('.wp-first-item').addClass('current');
		// menu hacks
		$('.taxonomy-aesop_stories_collections .toplevel_page_aesop-stories').addClass('wp-has-current-submenu').find('li:nth-child(4)').addClass('current');

	});

}(jQuery));