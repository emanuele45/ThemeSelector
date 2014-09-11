<?php

/**
 * Theme Selector
 *
 * @name      Theme Selector
 * @copyright Theme Selector contributors
 * @license   BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.1.1
 *
 */

function template_th_themeselector()
{
	global $context;

	if (empty($context['ThemeSelector']))
		return;

	// The form is necessary for placement in the (1.0) default theme
	echo '
	<form id="theme_selector">
		<select >';

	foreach ($context['ThemeSelector'] as $theme_id => $theme)
	{
		if (empty($theme['variants']))
		{
			echo '
			<option value="', $theme_id, '"', $theme['selected'] ? ' selected="selected"' : '', '>', $theme['name'], '</option>';
		}
		else
		{
			echo '
			<optgroup label="', $theme['name'], '">';
			foreach ($theme['variants'] as $key => $variant)
				echo '
				<option value="', $theme_id, '_', $key, '"', $variant['selected'] ? ' selected="selected"' : '', '>', $variant['name'], '</option>';
			echo '
			</optgroup>';
		}
	}

	echo '
		</select>
	</form>';
}