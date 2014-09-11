/**
 * Theme Selector
 *
 * @name      Theme Selector
 * @copyright Theme Selector contributors
 * @license   BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.1.2
 *
 */

$(document).ready(function() {
	$('#theme_selector select').change(function() {
		var theme = $(this).val().split(/_(.+)?/),
			variant = theme.length === 1 ? '' : ';variant=' + theme[1];

		$.ajax({
			type: "GET",
			dataType: "html",
			url: elk_scripturl + '?xml;theme=' + theme[0] + variant
		})
		.done(function(request) {
			location.reload(true);
		});
	});
});