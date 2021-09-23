/*------------------------------------------------------------------------
# mod_sp_poll - Ajax poll module by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2016 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/

jQuery(function($) {
	$('.form-sppoll').on('submit', function(event) {
		event.preventDefault();
		var self = $(this);

		var values = { id: self.data('id'), vote: self.find('input[type="radio"]:checked').val(), modid: self.data('module_id') };
		$.ajax({
			type: 'POST',
			url: "index.php?option=com_sppolls&task=poll.ajax",
			data: values,
			beforeSend: function () {
			},
			success: function (response) {
				self.hide();
				self.parent().find('.sppoll-results').html(response);
			}
		});
	});

	$('.btn-poll-result').on('click', function(event) {
		event.preventDefault();
		var parent = $(this).parent();

		var values = {
			id: $(this).data('result_id'),
			modid: parent.data('module_id'),
			subtask: 'result'
		};
		$.ajax({
			type: 'POST',
			url: "index.php?option=com_sppolls&task=poll.ajax",
			data: values,
			format: 'json',
			success: function (response) {
				parent.hide();
				parent.parent().find('.sppoll-results').html(response);
			}
		});

	});
});