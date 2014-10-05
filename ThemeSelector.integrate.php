<?php

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

class ThemeSelector
{
	public static function load_theme()
	{
		global $context, $modSettings, $txt, $settings, $user_info;

		if ($user_info['is_guest'])
		{
			$current_theme = !empty($_SESSION['id_theme']) ? $_SESSION['id_theme'] : 0;
			$current_variant = !empty($_SESSION['id_variant']) ? '_' . $_SESSION['id_variant'] : '';
		}
		else
		{
			$current_theme = !empty($user_info['theme']) ? $user_info['theme'] : 0;
			$current_variant = !empty($context['theme_variant']) ? $context['theme_variant'] : '';
		}

		if (($themes = cache_get_data('TS_themes_list', 3600)) === null)
		{
			loadLanguage('ManageThemes');
			require_once(SUBSDIR . '/Themes.subs.php');
			$themes = availableThemes($current_theme, $user_info['id']);

			cache_put_data('TS_themes_list', $themes, 3600);
		}

		foreach ($themes[0] as $theme_id => $theme)
		{
			$name = $theme['name'];
			$selected = $current_theme == $theme_id;

			$context['ThemeSelector'][$theme_id] = array('name' => $name, 'selected' => $selected, 'variants' => array());
			if (isset($theme['variants']))
			{
				foreach ($theme['variants'] as $key => $variant)
				{
					$context['ThemeSelector'][$theme_id]['variants'][$key] = array(
						'name' => $variant['label'],
						'selected' => $selected && $current_variant == '_' . $key
					);
				}
			}
		}

		if (!isset($context['theme_header_callbacks']))
			$context['theme_header_callbacks'] = array();

		$context['theme_header_callbacks'][] = 'themeselector';
		loadTemplate('ThemeSelector');
		loadJavascriptFile('ThemeSelector.js');
		loadCSSFile('ThemeSelector.css');
	}
}