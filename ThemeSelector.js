/**
 * Theme Selector
 *
 * @name      Theme Selector
 * @copyright Theme Selector contributors
 * @license   BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.1
 *
 */

$(document).ready(function() {
	$('#theme_selector').change(function() {
		var theme = $(this).val().split(/_(.+)?/),
			separator = document.URL.indexOf('?') === -1 ? '?' : ';',
			variant = theme.length === 1 ? '' : ';variant=' + theme[1],
			fragment = document.URL.indexOf('#') !== -1;

		if (fragment)
		{
			var url = document.URL.split('#');
			window.location = url[0] + separator + 'theme=' + theme[0] + variant + '#' + url[1];
		}
		else
			window.location = document.URL + separator + 'theme=' + theme[0] + variant;
	});
});